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
}
