<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
*  Route cho Administrator
*/


Route::prefix('admin')->group(function (){
    // Gom nhóm các route cho phần admin

    /*
     * URL: authen.com/admin/
     * Route mặc định của admin
     * */
    Route::get('/', 'AdminController@index')->name('admin.dashboard');


    /*
     * URL: authen.com/admin/dashboard
     * Route đăng nhập thành công
     * */

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    /*
     * URL: authen.com/admin/register
     * Route trả về view dùng để đăng ký tài khoản admin
     * */
    Route::get('register', 'AdminController@create')->name('admin.register');

    /*
     * URL: authen.com/admin/dashboard
     * Phương thức là POST
     * Route dùng để đăng ký một admin từ form POST
     * Note: Route GET chỉ dùng để trả về view còn route POST dùng để xử lý dữ liệu.
     * */
    Route::post('register', 'AdminController@store')->name('admin.register.store');
});