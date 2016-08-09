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
		//网站首页
		Route::get('/' , ['as'=>'admin.home' , 'uses'=>'AdminController@index']);
	});
	
	//管理员管理
	Route::group(['prefix'=>'manager'] , function(){
		//管理员列表页
		Route::get('/', ['as'=>'admin.manager' , 'uses'=>'ManagerController@index']);
		//管理员添加页
		Route::get('create', ['as'=>'admin.manager.create' , 'uses'=>'ManagerController@create']);
		//新建管理员保存
		Route::post('store', 'ManagerController@store');
		//编辑管理员
		Route::get('edit/{userId}', ['as'=>'admin.manager.edit' , 'uses'=>'ManagerController@edit']);
		//保存编辑
		Route::post('update','ManagerController@update');
		//删除管理员
		Route::get('destroy/{id}' , ['as'=>'admin.manager.delete', 'uses'=>'ManagerController@destroy']);
	});
	
	//用户管理
	Route::group(['prefix'=>'user'] , function(){
		//用户列表
		Route::get('/' , ['as'=>'admin.user' , 'uses'=>'UserController@index']);
		//删除用户
		Route::get('destroy/{id}' , ['as'=>'admin.user.delete' , 'uses'=>'UserController@destroy']);
	});
	//权限管理
	Route::group(['prefix'=>'permission'] , function(){
		//权限列表
		Route::get('/' , ['as'=>'admin.auth' , 'uses'=>'PermissionController@index']);
		//添加权限
		Route::get('create' , ['as'=>'admin.auth.create' , 'uses'=>'PermissionController@create']);
		//保存权限
		Route::post('store' , 'PermissionController@store');
		//编辑权限
		Route::get('edit/{id}' , ['as'=>'admin.auth.edit' , 'uses'=>'PermissionController@edit']);
		//保存编辑
		Route::post('update' , 'PermissionController@update');
		//删除权限
		Route::get('destroy/{id}' , ['as'=>'admin.auth.delete' , 'uses'=>'PermissionController@destroy']);
	});
	
	Route::group(['prefix'=>'role'] , function(){
        //权限角色列表页
        Route::get('/' , ['as'=>'admin.role' , 'uses'=>'RoleController@index']);
        //添加权限角色
        Route::get('create' , ['as'=>'admin.role.create' , 'uses'=>'RoleController@create']);
        //保存权限角色
        Route::post('store' , 'RoleController@store');
        //修改权限角色
        Route::get('edit/{id}' , ['as'=>'admin.role.edit' , 'uses'=>'RoleController@edit']);
        //保存修改
        Route::post('update', 'RoleController@update');
        //删除权限角色
        Route::get('destroy/{id}' , ['as'=>'admin.role.destroy' , 'uses'=>'RoleController@destroy']);
        //编辑角色拥有的权限
        Route::get('show/{id}' , ['as'=>'admin.role.show' , 'uses'=>'RoleController@show']);
        //保存编辑
        Route::post('store_role' , 'RoleController@store_role');
	});	
	
	//分类管理(日记分类)
	/*Route::group(['prefix'=>'category'] , function(){
		Route::get('/' , ['as'=>'admin.category' , 'uses'=>'CategoryController@index']);
	});*/
	
	//房源管理
	Route::group(['prefix'=>'room'] , function(){
		//房源列表
		Route::get('index/{type?}' , ['as'=>'admin.room' , 'uses'=>'RoomController@index']);
		//添加房源
		Route::get('create' , ['uses'=>'RoomController@create' , 'as'=>'admin.room.create']);
		//保存添加
		Route::post('store' , ['uses'=>'RoomController@store' , 'as'=>'admin.room.store']);
		//修改房源信息
		Route::get('edit/{id}' , ['uses'=>'RoomController@edit' , 'as'=>'admin.room.edit']);
		//保存修改
		Route::post('update' , ['uses'=>'RoomController@update' , 'as'=>'admin.room.update']);
		//删除房源信息
		Route::get('destroy/{id}' , ['uses'=>'RoomController@destroy' , 'as'=>'admin.room.destroy']);
		//推荐
		Route::get('recommend/{id}' , ['uses'=>'RoomController@recommend' , 'as'=>'admin.room.recommend']);
		//查看房子信息
		Route::get('show/{id}' , ['uses'=>'RoomController@show' , 'as'=>'admin.room.show']);
		//上传图片
		Route::post('upload' , ['uses'=>'RoomController@upload' , 'as'=>'admin.room.upload']);
		//删除图片
		Route::get('del_pic/{id}' , ['uses'=>'RoomController@del_pic' , 'as'=>'admin.room.del_pic']);
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







