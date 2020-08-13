<?php

// use Illuminate\Routing\Route;

error_reporting(0);
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

// Route::get('/', function () {
//     return view('welcome');
// });

// use Illuminate\Routing\Route;


Route::group(['prefix' => 'admin', 'namespace' => 'Admin',], function () {
    //登陆页面
    Route::get('login', 'LoginController@login');

    //生成验证码
    Route::get('code', 'LoginController@code');

    //登陆方法
    Route::post('dologin', 'LoginController@doLogin');

    //加密测试
    Route::get('jiami', 'LoginController@jiami');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'Islogin'], function () {
    //后台首页
    Route::get('index', 'IndexController@index');

    //后台欢迎页
    Route::get('welcome', 'IndexController@welcome');

    //退出登陆
    Route::get('logout', 'LoginController@logout');
});
