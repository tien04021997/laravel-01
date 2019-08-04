<?php

namespace App\Http\Controllers\Auth\Shipper;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:shipper')->except('logout');
    }

    /*
     * Phương thức trả về view dùng để đăng nhập seller
     *
     * */

    public function login()
    {
        return view('shipper.auth.login');
    }

    /*
     * Phương thức này dùng để đăng nhập cho seller
     * Lấy thông tin từ form có METHOD là POST
     * */
    public function loginShipper(Request $request){
        // Validate gia tri
        $this -> validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));

        // Dang nhap
        if (Auth::guard('shipper')->attempt(
            ['email' => $request->email, 'password' => $request->password], $request->remember
        )){
            // Nếu đăng nhập thành công trả về view dashboard của shipper
            return redirect()->intended(route('shipper.dashboard'));
        }

        // nếu đăng nhập thất bại thì sẽ quay về ô đăng nhập
        // Với giá trị của 2 ô input cũ là email và remember

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
