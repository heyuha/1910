<?php

use Illuminate\Support\Facades\Route;

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


Route::domain('admin.laravel.com')->group(function(){
//后台品牌
	Route::get('/', function () {
	// echo "123";
	    return view('welcome');
	});
		Route::prefix('/brand')->middleware('auth')->group(function(){
			Route::get('/','Admin\BrandController@index');
			Route::get('create','Admin\BrandController@create');//
			Route::post('store','Admin\BrandController@store');//商品添加页面
			
			Route::get('edit/{id}','Admin\BrandController@edit');//编辑展示页面
			Route::post('update/{id}','Admin\BrandController@update');//修改页面
			Route::get('destroy/{id}','Admin\BrandController@destroy');//删除页面
		});

		//后台分类
		Route::prefix('/cate')->middleware('auth')->group(function(){
			Route::get('/','Admin\CateController@index');
			Route::get('create','Admin\CateController@create');//
			Route::post('store','Admin\CateController@store');//商品添加页面
			Route::get('edit/{id}','Admin\CateController@edit');//编辑展示页面
			Route::post('update/{id}','Admin\CateController@update');//修改页面
			Route::get('destroy/{id}','Admin\CateController@destroy');//删除页面
		});

		//后台商品管理
		Route::prefix('/goods')->middleware('auth')->group(function(){
			Route::get('/','Admin\GoodsController@index');
			Route::get('create','Admin\GoodsController@create');//
			Route::post('store','Admin\GoodsController@store')->name('goodsstore');//商品添加页面
			Route::get('edit/{id}','Admin\GoodsController@edit');//编辑展示页面
			Route::post('update/{id}','Admin\GoodsController@update')->name('goodsupdate');//修改页面
			Route::get('destroy/{id}','Admin\GoodsController@destroy');//删除页面
		});

		//后台商品管理
		Route::prefix('/admin')->middleware('auth')->group(function(){
			Route::get('/','Admin\AdminController@index');
			Route::get('create','Admin\AdminController@create');//
			Route::post('store','Admin\AdminController@store');//商品添加页面
			Route::get('edit/{id}','Admin\AdminController@edit');//编辑展示页面
			Route::post('update/{id}','Admin\AdminController@update');//修改页面
			Route::get('destroy/{id}','Admin\AdminController@destroy');//删除页面
		});

		//后台商品管理
		Route::prefix('/wangzhi')->middleware('auth')->group(function(){
			Route::get('/','Admin\WangzhiController@index');
			Route::get('create','Admin\WangzhiController@create');//添加方法
			Route::post('store','Admin\WangzhiController@store');//添加页面
			Route::get('edit/{id}','Admin\WangzhiController@edit');//编辑展示页面
			Route::post('update/{id}','Admin\WangzhiController@update');//修改页面
			Route::get('destroy/{id}','Admin\WangzhiController@destroy');//删除页面
		});
		
		Auth::routes();
		Route::get('/home','HomeController@index')->name('home');

});


//前台
Route::domain("www.laravel.com")->group(function(){
	// 前台首页
	Route::get('/',"Index\IndexController@index")->name('shop.index');


	Route::prefix('/login')->group(function(){
		route::get("/","Index\LoginController@login");
		// 登录注册
		route::get("/reg","Index\LoginController@reg");
		// 手机号发送短信验证码
		Route::post("/sendSms","Index\LoginController@sendSms");
		// 邮箱发送验证码
		Route::get("/sendEmail","Index\LoginController@sendEmail");

		// 执行添加
		Route::post('/regstore',"Index\LoginController@regstore");

		// 登录验证账号密码
		Route::post("/loginstore","Index\LoginController@loginstore");
		// 列表页面
		Route::get("/proinfo/{id}","Index\LoginController@proinfo")->name("shop.proinfo");

	});

	// 购物车
	Route::prefix('/cart')->group(function(){
		Route::get('/cartadd',"Index\CartController@cartadd");
		Route::get('/cartcar',"Index\CartController@cartcar")->name('shop.car');
		Route::get('/cartpay/{id}',"Index\CartController@cartpay");
	});

	

});

