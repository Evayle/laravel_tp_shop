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

//后台首页
Route::get('admin','Admin\IndexController@index');

//后台添加页面
Route::resource('admin/user','Admin\UserController');

































































































// 友情链接
// Route::get('admin/friendship/setdata','Admin\FriendshipController@setdata');
Route::resource('admin/friendship','Admin\FriendshipController');



// 前台首页
Route::get('home','Home\IndexController@index');
Route::resource('home/shopcart','Home\ShopcartController');