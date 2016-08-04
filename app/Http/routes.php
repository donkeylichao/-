<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/******************************************************************
home ,前台的所有路由
*****************************************************************/
Route::group(['prefix'=>'donkey/home' , 'namespace'=>'Home'] , function(){
	
	Route::get('/', 'WelcomeController@index');

	Route::get('', 'HomeController@index');

});



/***************************************************************
登陆和三方登陆的路由写这里
****************************************************************/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);	

	
Route::group(['prefix'=>'donkey/admin/auth' , 'namespace'=>'Admin\Auth'] , function(){
	Route::get('login' , 'AuthController@getLogin');
	
	Route::post('login', 'AuthController@postLogin');
	
	Route::get('logout' , 'AuthController@getLogout');
});
/****************************************************************
admin 后台的所有路由
*****************************************************************/
Route::group(['prefix'=>'donkey/admin' , 'namespace'=>'Admin' , 'middleware'=>'AppAdmin'], function(){
		
	//网站统计
	Route::group(['prefix'=>'home'] , function(){
		Route::get('/' , ['as'=>'admin.home' , 'uses'=>'AdminController@index']);
	});
	
	//用户管理
	Route::group(['prefix'=>'user'] , function(){
		Route::get('/', ['as'=>'admin.user' , 'uses'=>'UserController@index']);
		Route::get('create', ['as'=>'admin.user.create' , 'uses'=>'UserController@create']);
		Route::post('store', ['as'=>'admin.user.add' , 'uses'=>'UserController@store']);
		Route::get('edit/{userId}', ['as'=>'admin.user.edit' , 'uses'=>'UserController@edit']);
		Route::post('update', ['as'=>'admin.user.update', 'uses'=>'UserController@update']);
	});
	
	//权限管理
	Route::group(['prefix'=>'permission'] , function(){
		Route::get('/' , ['as'=>'admin.auth' , 'uses'=>'PermissionController@index']);
	});
	
	Route::group(['prefix'=>'role'] , function(){
		Route::get('/' , ['as'=>'admin.role' , 'uses'=>'RoleController@index']);
	});	
	
	//分类管理(日记分类)
	Route::group(['prefix'=>'category'] , function(){
		Route::get('/' , ['as'=>'admin.category' , 'uses'=>'CategoryController@index']);
	});
	
	//房源管理
	Route::group(['prefix'=>'room'] , function(){
		Route::get('/' , ['as'=>'admin.room' , 'uses'=>'RoomController@index']);
	});
	
	//视屏管理
	Route::group(['prefix'=>'video'] , function(){
		Route::get('/' , ['as'=>'admin.video' , 'uses'=>'VideoController@index']);
	});
	
	//音频管理
	Route::group(['prefix'=>'music'] , function(){
		Route::get('/' , ['as'=>'admin.music' , 'uses'=>'NusicController@index']);
	});
	
	//图片管理
	Route::group(['prefix'=>'photo'] , function(){
		Route::get('/' , ['as'=>'admin.photo' , 'uses'=>'PhotoController@index']);
	});
	
	//日记管理
	Route::group(['prefix'=>'post'] , function(){
		Route::get('/' , ['as'=>'admin.post' , 'uses'=>'PostController@index']);
	});
	
	//评论管理
	Route::group(['prefix'=>'comment'] , function(){
		Route::get('/' , ['as'=>'admin.comment' , 'uses'=>'CommentController@index']);
	});
	
	//消息管理
	Route::group(['prefix'=>'notification'] , function(){
		Route:;get('/' , ['as'=>'admin.notification' , 'uses'=>'NotifycationController@index']);
	});
	
	//个人中心
	Route::group(['prefix'=>'personal'] , function(){
		Route::get('/' , ['as'=>'admin.personal' , 'uses'=>'PersonalController@index']);
	});
});







