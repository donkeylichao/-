<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Resource;
use Illuminate\Http\Request;

class VideoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$videos = Resource::where('type_id' , 1)->with('category')->get();
		return view('admin.video.index')->with(compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$compact = [];

		$categories = Category::with('child')->find(1);
		$compact[] = 'categories';

		return view('admin.video.create')->with(compact($compact));
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	/**
	 *	回收站列表
	 *
	 */
	public function restore()
	{
		return view('admin.video.restore');
	}
}
