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





































// 后台分类管理	
Route::get('admin/category/create/{id}','Admin\CategoryController@create');
Route::resource('admin/category','Admin\CategoryController');

// 后台商品管理	
Route::resource('admin/goods','Admin\GoodsController');