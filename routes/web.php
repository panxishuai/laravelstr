<?php
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

//用户添加路由
Route::get('user/add', 'UserController@add');
//添加操作
Route::post('user/store', 'UserController@store');
//用户列表页面路由
Route::get('user/index', 'UserController@index');
//修改页面
Route::get('user/edit/{id}', 'UserController@edit');
//修改方法路由
Route::post('user/update', 'UserController@update');
