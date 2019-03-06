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


Route::get('/',function(){
return view('home.index.index');
});

//主页路由.验证登录(测试)
Route::get('admin/info',function(){
    // 存储一条数据至 Session 中...
    session(['admin_login' => null]);
    return 123;

});


//后台登录页面
Route::get('admin/login','Admin\LoginController@index')->name('login');

Route::group(['middleware'=>'login'],function(){

    Route::get('admin','Admin\IndexController@index');

    //后台添加页面
    Route::resource('admin/user','Admin\UserController');

    //退出登录
    Route::any('admin/loutgin','Admin\LoginController@session');
    // 友情链接
    // Route::get('admin/friendship/setdata','Admin\FriendshipController@setdata');
    Route::resource('admin/friendship','Admin\FriendshipController');




});

//ajax验证后台登录路由
Route::any('admin/denglu','Admin\LoginController@login');

//ajax验证后台登录路由(测试)
Route::post('admin/deng','Admin\LoginController@deng');

// 前台首页
Route::get('home','Home\IndexController@index');
Route::resource('home/shopcart','Home\ShopcartController');





































































































