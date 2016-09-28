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
Route::group(['prefix'=>'donkey' , 'namespace'=>'Home'] , function(){
	//首页
	Route::controller('home', 'HomeController');
	//房子列表页
	Route::controller('room/{type?}' , 'RoomController');
	//视频列表
	Route::controller('video/{category_id?}' , 'VideoController');
	//日记列表
	Route::controller('post/{category?}' , 'PostController');
	//文件
	Route::controller('pdf/{category?}' , 'PdfController');
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
		
	//分类管理(视频，音频，图片，日记分类)
	Route::group(['prefix'=>'category'] , function(){
		//查看分类树
		Route::get('/' , ['as'=>'admin.category' , 'uses'=>'CategoryController@index']);
		//添加分类
		Route::get('create' , ['as'=>'admin.category.create' , 'uses'=>'CategoryController@create']);
		//保存添加
		Route::post('store' , 'CategoryController@store');
		//跟新分类
		Route::post('update' , ['as'=>'admin.category.update' , 'uses'=>'CategoryController@update']);
		//删除分类
		Route::get('destroy/{id}' , ['as'=>'admin.category.destroy' , 'uses'=>'CategoryController@destroy']);
	});
	
	//视频管理
	Route::group(['prefix'=>'video'] , function(){
		//视频列表
		Route::get('index' , ['as'=>'admin.video' , 'uses'=>'VideoController@index']);
		//添加视频
		Route::get('create' , ['as'=>'admin.video.create' , 'uses'=>'VideoController@create']);
		//保存添加
		Route::post('store' , 'VideoController@store');
		//修改视频
		Route::get('edit/{id}' , ['as'=>'admin.video.edit' , 'uses'=>'VideoController@edit']);
		//保存修改
		Route::post('update' , 'VideoController@update');
		//回收站
		Route::get('recycle' , ['as'=>'admin.video.recycle' , 'uses'=>'VideoController@recycle']);
		//恢复回收站内容
		Route::get('restore/{id}' , ['as'=>'admin.video.restore' , 'uses'=>'VideoController@restore']);
		//彻底删除回收站内容
		Route::get('delete/{id}' , ['as'=>'admin.video.delete' , 'uses'=>'VideoController@delete']);
		//视频上传
		Route::post('uploadv' , 'VideoController@uploadv');
		//视频删除
		Route::get('destroy/{id}' , ['as'=>'admin.video.destroy' , 'uses'=>'VideoController@destroy']);
		//查看视频
		Route::get('show/{id}' , ['as'=>'admin.video.show' , 'uses'=>'VideoController@show']);
		//编辑信息
		Route::get('edit/{id}' , ['as'=>'admin.video.edit' , 'uses'=>'VideoController@edit']);
	});
	
	//音频管理
	Route::group(['prefix'=>'music'] , function(){
		//显示音频列表
		Route::get('index' , ['as'=>'admin.music' , 'uses'=>'MusicController@index']);
		//添加音频
		Route::get('create' , ['as'=>'admin.music.create' , 'uses'=>'MusicController@create']);
		//保存音频
		Route::post('store' , 'MusicController@store');
		//上传音频
		Route::post('uploadm' , 'MusicController@uploadm');
		//查看内容
		Route::get('show/{id}' , ['as'=>'admin.music.show' , 'uses'=>'MusicController@show']);
		//编辑音频
		Route::get('edit/{id}' , ['as'=>'admin.music.edit' , 'uses'=>'MusicController@edit']);
		//保存编辑
		Route::post('update' , 'MusicController@update');
		//放入回收站
		Route::get('destroy/{id}' , 'MusicController@destroy');
		//回收站列表
		Route::get('recycle' , ['as'=>'admin.music.recycle' , 'uses'=>'MusicController@recycle']);
		//恢复回收站内容
		Route::get('restore/{id}' , ['as'=>'admin.music.restore' , 'uses'=>'MusicController@restore']);
		//彻底删除
		Route::get('delete/{id}' , ['as'=>'admin.music.delete' , 'uses'=>'MusicController@delete']);
	});
	
	//图片管理
	Route::group(['prefix'=>'album'] , function(){
		//相册列表
		Route::get('index' , ['as'=>'admin.album' , 'uses'=>'AlbumController@index']);
		//回收站
		Route::get('recycle' , ['as'=>'admin.album.recycle' , 'uses'=>'AlbumController@index']);
	});
	
	//日记管理
	Route::group(['prefix'=>'post'] , function(){
		//显示日记列表
		Route::get('index' , ['as'=>'admin.post' , 'uses'=>'PostController@index']);
		//添加分类
		Route::get('create_type',['as'=>'admin.post.create_types' , 'uses'=>'PostController@create_type']);
		//保存分类
		Route::post('store_type' , 'PostController@store_type');
		//分类列表
		Route::get('type_index' , ['as'=>'admin.pdf.type_index' , 'uses'=>'PostController@type_index']);
		//编辑分类
		Route::post('type_update' , 'PostController@type_update');
		//删除分类
		Route::get('destroy_type/{id}' , ['as'=>'admin.pdf.destroy_type' , 'uses'=>'PostController@destroy_type']);
		//添加日记
		Route::get('create',['as'=>'admin.post.create' , 'uses'=>'PostController@create']);
		//保存日记
		Route::post('store' , 'PostController@store');
		//编辑日记
		Route::get('edit/{id}' , ['as'=>'admin.post.edit' , 'uses'=>'PostController@edit']);
		//保存编辑
		Route::post('update' , 'PostController@update');
		//删除日记
		Route::get('destroy/{id}' , ['as'=>'admin.post.delete' , 'uses'=>'PostController@destroy']);
		//回收站
		Route::get('recycle' , ['as'=>'admin.post.recycle' , 'uses'=>'PostController@recycle']);
		//彻底删除
		Route::get('delete/{id}' , ['as'=>'admin.post.delete' , 'uses'=>'PostController@delete']);
		//回复回收站的内容
		Route::get('restore/{id}' , ['as'=>'admin.post.restore' , 'uses'=>'PostController@restore']);
		//上传图片
		Route::post('img_upload' , 'PostController@img_upload');
	});
	
	//pdf文件管理
	Route::group(['prefix'=>'pdf'] , function(){
		//文件列表
		Route::get('index',['as'=>'admin.pdf' , 'uses'=>'PdfController@index']);
		//浏览pdf文档
		Route::get('show/{id}' , ['as'=>'admin.pdf.show' , 'uses'=>'PdfController@show']);
		//添加分组
		Route::get('create_type' , ['as'=>'admin.pdf.create_type' , 'uses'=>'PdfController@create_type']);
		//保存添加分组
		Route::post('store_type' , 'PdfController@store_type');
		//分组列表
		Route::get('type_index' , ['as'=>'admin.pdf.type_index' , 'uses'=>'PdfController@type_index']);
		//跟新分组列表
		Route::post('type_update' , 'PdfController@type_update');
		//删除分组
		Route::get('destroy_type/{id}' , ['as'=>'admin.pdf.destroy_type' , 'uses'=>'PdfController@destroy_type']);
		//上传文件
		Route::get('create' , ['as'=>'admin.pdf.create' , 'uses'=>'PdfController@create']);
		//保存上传
		Route::post('store' , ['as'=>'admin.pdf.store' , 'uses'=>'PdfController@store']);
		//删除
		Route::get('destroy/{id}' , 'PdfController@destroy');
		//回收站列表
		Route::get('recycle' , ['as'=>'admin.pdf.recycle' , 'uses'=>'PdfController@recycle']);
		//恢复内容
		Route::get('restore/{id}' , ['as'=>'admin.pdf.restore' , 'uses'=>'PdfController@restore']);
		//彻底删除
		Route::get('delete/{id}' , ['as'=>'admin.pdf.delete' , 'uses'=>'PdfController@delete']);
	});
	
	//评论管理
	Route::group(['prefix'=>'comment'] , function(){
        //评论列表
		Route::get('/' , ['as'=>'admin.comment' , 'uses'=>'CommentController@index']);
	    //查看评论
        Route::get('show/{id}' , ['as'=>'admin.comment.show' , 'uses'=>'CommentController@show']);
        //删除评论
        Route::get('destroy/{id}' , ['as'=>'admin.comment.destroy' , 'uses'=>'CommentController@destroy']);
        //修改评论
        Route::get('edit/{id}' , ['as'=>'admin.comment.edit' , 'uses'=>'CommentController@edit']);
        //保存修改
        Route::post('update' , 'CommentController@update');
    });
	
	//消息管理
	Route::group(['prefix'=>'notification'] , function(){
		//消息类表
		Route::get('/' , ['as'=>'admin.notification' , 'uses'=>'NotificationController@index']);
		//标记已查看
		Route::get('update/{id}' , ['as'=>'admin.notification.update' , 'uses'=>'NotificationController@update']);
		//删除消息
		Route::get('destroy/{id}' , ['as'=>'admin.notification.destroy' , 'uses'=>'NotificationController@destroy']);
	});
	
	//个人中心
	Route::group(['prefix'=>'personal'] , function(){
		//首页
		Route::get('/' , ['as'=>'admin.personal' , 'uses'=>'PersonalController@index']);
		//修改页
		Route::get('update' , 'PersonalController@update');
		//修改头像
		Route::post('headimg' , 'PersonalController@headimg');
	});
	
	//表情管理
	Route::group(['prefix'=>'emoji'] , function(){
		//表情列表
		Route::get('index' , ['as'=>'admin.emoji' , 'uses'=>'EmojiController@index']);
		//添加表情
		Route::get('create' , ['as'=>'admin.emoji.create' , 'uses'=>'EmojiController@create']);
		//保存添加
		Route::post('store' , 'EmojiController@store');
		//修改表情
		Route::get('edit/{id}' , ['as'=>'admin.emoji.edit' , 'uses'=>'EmojiController@edit']);
		//保存修改
		Route::post('update' , 'EmojiController@update');
		//删除表情
		Route::get('destroy/{id}' , ['as'=>'amdin.emoji.destroy' , 'uses'=>'EmojiController@destroy']);
	});
	
});


/**********************************************************
	app后台资源下载相关路由
********************************************************/
Route::group(['prefix' => 'donkey/download' , 'namespace'=>'Download' ] , function(){
	//视频下载
	Route::get('video/{id}' , 'DownloadController@video');
	//音频下载
	Route::get('music/{id}' , 'DownloadController@music');
});


/********************************************************
	服务接口
*********************************************************/
	//测试用的
Route::group(['prefix'=>'donkey/api' , 'namespace'=>'Api'] , function(){
	Route::get('/' , 'ExcelController@index');
});
//以上为测试用的

//服务
Route::group(['prefix'=>'donkey/server' , 'namespace'=>'Service'] , function(){
	//发送邮件服务
	Route::get('mail' , 'MailController@index');
});




