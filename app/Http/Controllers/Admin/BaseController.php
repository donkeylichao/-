<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Auth,Config;
use App\Models\Album;
use App\Models\Resource;

class BaseController extends Controller {
	
	const PAGE_NUM = 10;
	public function  __construct()
	{
		$this->middleware('auth.admin');
	}
	
	/**
	 * 记录后台个人操作消息
	 *	@$content 消息内容，
	 *	@$iid 产生信息人id
	 */
	public function informs($content,$iid)
	{
		$note = new Notification;
		$note->body = rtirm($content);
		$note->from_id = $iid;
		$note->save();
	}
	
	/**
	 *	记录后台操作别人信息
	 *	@$content 消息内容，
	 *	@$iid 产生信息人id
	 *	@$pid 被操作用户的id
	 */
	 
	 public function messages($content,$iid,$pid)
	 {
		$note = new Notification;
		$note->body = $content;
		$note->from_id = $iid;
		$note->user_id = $pid;
		$note->save();
	 }
	 
	 /**
	  * 记录用户操作信息
	  *	@resource 操作内容的名称
	  *	@handle 操作类型，有效类型为create,update,delete
	  * @type 类型，是哪个类型资源产生的消息 1视频2音频3相册
	  *	视频: create,update,delete为名称
	  *	音频：create,update,delete为名称
	  *	
	  */
	public function record($handle,$resource,$type)
	{
		//获取当前用户的id;
		$user_id = Auth::user()->id;
		
		//新建一个消息实例;
		$notify = new Notification;
		
		$notify->user_id = $user_id;//产生消息的用户
		
		//判断类型
		switch($type) {
			case 1:
				$res = Resource::withTrashed()->find($resource);
				$title = $res->title;
				$resource_id = $res->id;
				$album_id = '';
				break;
			case 2:
				$res = Resource::withTrashed()->find($resource);
				$title = $res->title;
				$resource_id = $res->id;
				$album_id = '';
				break;
			case 3:
				$alb = Album::withTrashed()->find($resource);
				$title = $alb->name;
				$album_id = $alb->id;
				$resource_id = '';
				break;
		}
		
		$notify->type = $type;
		
		switch($handle) {
			case 'create':
				$notify->body = '添加了' . Config::get('common.types')[$type] . '《' . $title . '》';
				$notify->resource_id = $resource_id;
				$notify->album_id = $album_id;
				$notify->modify_type = 1;
				break;
			case 'update':
				$notify->body = "更新了" . Config::get('common.types')[$type] . '《' . $title . '》';
				$notify->resource_id = $resource_id;
				$notify->album_id = $album_id;
				$notify->modify_type = 2;
				break;
			case 'delete':
				$notify->body = "删除了" . Config::get('common.types')[$type] . '《' . $title . '》';
				$notify->resource_id = $resource_id;
				$notify->album_id = $album_id;
				$notify->modify_type = 3;
				break;
		}
		$notify->save();
	}
}
