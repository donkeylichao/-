<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Auth;

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
	  *	@resource 操作的内容id,如果是删除内容，传删除内容的名称
	  *	@handle 操作类型，有效类型为create,update,delete
	  *	视频:create，update为id,delete为名称
	  *	音频：create,update为id,delete为名称
	  *	相册：create,update为id,delete为相册名称，对相册图片的添加和删除都属于更新相册。
	  *	
	  */
	public function record($handle,$resource)
	{
		$user_id = Auth::user()->id;
		$notify = new Notification;
		$notify->user_id = $user_id;
		
		switch($handle) {
			case create:
				$notify->body = '添加了';
				$notify->from_id = $resource;
			case update:
				$notify->body = "更新了";
				$notify->from_id = $resource;
			case delete:
				$notify->body = "删除了" . $resource;
		}
		$notify->save();
	}
}
