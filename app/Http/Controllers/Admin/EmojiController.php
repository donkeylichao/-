<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Emoji;
use Illuminate\Http\Request;
use Input;

class EmojiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$name = Input::get('name');
		$emojis = Emoji::orderBy("created_at","desc");
		if($name) {
			$emojis = $emojis->where('name',"like" ,"%".$name."%");
		}
		
		$emojis = $emojis->paginate(10);
		
		$compact = [];
		$compact[] = "emojis";
		$compact[] = 'name';
		return view("admin.emoji.index")->with(compact($compact));	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.emoji.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,
			['name'=>'required','mark'=>'required'],
			['name.required'=>'名称不能为空!','mark.required'=>'替代标记不能为空!']	
		);
		$name = rtrim($request->input('name'));
		$mark = rtrim($request->input('mark'));
		
		$file = $request->file("path");
		if($file->isValid()) {
			$mimeType = $file->getMimeType();
			switch($mimeType) {
				case "image/jpeg":
					$ext = ".jpg";
					break;
				case "image/png":
					$ext = ".png";
					break;
				case "image/gif":
					$ext = ".gif";
					break;
				default:
					return back()->withInput()->with("notify_error" , "图片格式不对!");
			}
			$filename = time().$ext;
			$file->move(public_path("uploads/emojis") , $filename);	
			$path = "/uploads/emojis/".$filename;
		}
		$emoji = New Emoji;
		$emoji->name = $name;
		$emoji->mark = $mark;
		$emoji->path = $path;
		if(!$emoji->save()) {
			return back()->withInput()->with("notify_error" , "添加表情失败!");
		}
		return redirect("donkey/admin/emoji/index")->with("notify_success" , "添加表情成功!");
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
		$emoji = Emoji::find($id);
		return view('admin.emoji.edit')->with(compact("emoji"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$this->validate($request,
			['name'=>'required','mark'=>'required','id'=>'required'],
			['name.required'=>'名称不能为空!','mark.required'=>"标记不能为空!",'id.required'=>'您修改的表情不存在!']
		);
		$id = $request->input("id");
		$emoji = Emoji::find($id);
		$emoji->name = rtrim($request->input('name'));
		$emoji->mark = rtrim($request->input('mark'));
		if(!$emoji->save()) {
			return back()->withInput()->with("notify_error" , "修改失败!");
		}
		return redirect("/donkey/admin/emoji/index")->with("notify_success" , "修改成功!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$emoji = Emoji::find($id);
		$file = public_path($emoji->path);
		if(file_exists($file)) {
			unlink($file);
		}
		if(!$emoji->delete()) {
			return back()->with("notify_error","删除失败!");
		}
		return back()->with("notify_success" ,"删除成功!");
	}
}
