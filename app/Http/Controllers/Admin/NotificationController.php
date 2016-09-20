<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$notifications = Notification::where("is_read",0)->paginate(10);
		return view("admin.notification.index")->with("notifications",$notifications);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$n = Notification::where("id",$id)->update(['is_read'=>1]);
		if(!$n){
			return back()->with("notify_error","编辑已查看失败！");
		}
		return back()->with("notify_success","编辑已查看成功!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Notification::destroy($id)) {
			return back()->with("notify_error","删除失败!");
		}
		return back()->with("notify_success","删除成功!");
	}

}
