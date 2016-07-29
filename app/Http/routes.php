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


/****************************************************************
admin 后台的所有路由
*****************************************************************/
Route::group(['prefix'=>'donkey/admin' , 'namespace'=>'Admin' , 'middleware'=>'AppAdmin'], function(){
	
	//网站统计
	Route::get('/' , ['as'=>'admin.home' , 'uses'=>'AdminController@index']);
	
	//用户管理
	Route::get('user' , ['as'=>'admin.user' , 'uses'=>'UserController@index']);
	
	//权限管理
	Route::get('permission' , ['as'=>'admin.auth' , 'uses'=>'PermissionController@index']);
	
	Route::get('role' ,['as'=>'admin.role' , 'uses'=>'RoleController@index']);	
	
	//分类管理(日记分类)
	Route::get('category' , ['as'=>'admin.category' , 'uses'=>'CategoryController@index']);
	
	//房源管理
	Route::get('room', ['as'=>'admin.room' , 'uses'=>'RoomController@index']);
	
	//视屏管理
	Route::get('video' , ['as'=>'admin.video' , 'uses'=>'VideoController@index']);
	
	//音频管理
	Route::get('music' , ['as'=>'admin.music' , 'uses'=>'MusicController@index']);
	
	//图片管理
	Route::get('photo' , ['as'=>'admin.photo' , 'uses'=>'PhotoController@index']);
	
	//日记管理
	Route::get('post' , ['as'=>'admin.post' , 'uses'=>'PostController@index']);
	
	//评论管理
	Route::get('comment' , ['as'=>'admin.comment' , 'uses'=>'CommentController@index']);
	
	//消息管理
	Route::get('notification' , ['as'=>'admin.notification' , 'uses'=>'NotifycationController@index']);
	
	//个人中心
	Route::get('personal' , ['as'=>'admin.personal' , 'uses'=>'PersonalController@index']);
});







