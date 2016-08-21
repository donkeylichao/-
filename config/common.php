<?php

return [

	'permission_types' => [
		1  => '网站统计',
		2  => '用户管理',
		3  => '权限管理',
		4  => '房源管理',
		5  => '视频管理',
		6  => '音频管理',
		7  => '图片管理',
		8  => '日记管理',
		9  => '评论管理',
		10 => '消息管理',
		11 => '个人中心',
	],
	
	//房子管理的
	'house_types' => [
		1 => '出租',
		2 => '买卖',
	],
	
	//分类管理的
	'resource_types' => [
		1 => '视频',
		2 => '音频',
		3 => '图片',
		4 => '日记',
	],
	
	//提示消息notification的
	'types' => [
		1 => '视频',
		2 => '音频',
		3 => '相册',
	],
	
	//消息提示展示路劲
	'notify_routes' => [
		1 => 'donkey/admin/video/show/',
		2 => 'donkey/admin/music/show/',
		3 => 'donkey/admin/album/show/',
	],
	
	//上传的视频格式
	'video_types' => [
		'mp4',
	],
	
	//上传音频格式
	'music_types' => [
		'mp3',
	],

];
