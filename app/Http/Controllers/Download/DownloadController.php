<?php namespace App\Http\Controllers\Download;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class DownloadController extends Controller {

	/**
	 *  扫描二维码下载到手机上
	 *
	 * @return Response
	 */
	public function video($id)
	{
		$video = Resource::find($id);
		if(!file_exists(public_path($video->path))) {
			return "<h2>您下载的视频已被转移，无法下载，详情咨询站长！</h2>";
		}
		return response()->download(public_path($video->path),$video->title);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function music($id)
	{
		$music = Resource::find($id);
		if(!file_exists( public_path($music->path))) {
			return "<h2>您下载的音频已经被转移，无法下载，详情咨询站长!</h2>";
		}
		return response()->download(public_path($music->path),$music->title);
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

}
