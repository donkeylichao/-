<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\MusicRequest;
use Config;
use Auth;

class MusicController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$resource = Resource::where('type_id' , 2)->orderBy('created_at' , 'desc');
		$compact = [];
		
		//判断是否有搜索
		$name = $request->input('name') ? $request->input('name') : '';
		$compact[] = 'name';
		if($name) {
			$resource = $resource->where('title' , 'like' , '%'.$name.'%');
		}
		$musics = $resource->paginate(10);
		$compact[] = 'musics';
		
		$music_types = Category::where('pid' , 2)->get();
		$compact[] = 'music_types';
		
		return view('admin.music.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::find(2);
		return view('admin.music.create')->with(compact('categories'));
	}
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MusicRequest $request)
	{
		$resource = new Resource;
		
		//获取上传信息
		$title = $request->input('title');
		$content = $request->input('content');
		$author = $request->input('author');
		$category_id = $request->input('category_id');
		
		//图片上传
		$cover = $request->file('cover');
		if($cover->isValid()){
			$mime = $cover->getMimeType();
			switch($mime) {
				case "image/jpeg":
					$ext = '.jpg';
					break;
				case "image/png":
					$ext = '.png';
					break;
				default:
					return back()->withInput()->with('notify_error' , '图片类型不符合要求!');
			}
			$name = time() . $this->mrand() . $ext;
			
			$store_path = public_path('uploads/musics/');
			//文件夹
			$dir = date('Y-m-d' , time());
			if(!file_exists($store_path.$dir)) {
				mkdir($store_path.$dir , 0777);
			}
			$cover_path = '/uploads/musics/' . $dir . '/' . $name;
			$cover -> move($store_path.$dir, $name);
			$resource->cover = $cover_path;
		}
		
		$duration = $request->input('duration');
		$size = $request->input('size');
		$path = $request->input('path');
		
		$resource->type_id = 2; //上传的是音频
		$resource->category_id = $category_id; //栏目id
		$resource->title = $title; //标题
		$resource->content = $content; //介绍内容
		$resource->author = $author; //作者
		$resource->duration = $duration; //时长
		$resource->size = $size; //音频大小
		$resource->path = $path; //保存路劲
		$resource->user_id = Auth::user()->id; //发布内容用户的id

		if(!$resource->save()) {
			return back()->withInput()->with('notify_error' , '添加失败!');
		}
		
		//创建提示消息
		$id = Resource::where('path' , $path)->first()->id;
		$this->record('create' , $id , 2);
		return redirect('donkey/admin/music/index')->with('notify_success' , '添加成功!');
	}
	
	/**
	 * 上传音频
	 */
	public function uploadm(Request $request)
	{	
		$data = ['sta'=>true , 'msg'=>'上传成功!'];
		
		//判断是否是第二次上传，是则删除第一次的文件
		$old = $request->input('path') ? $request->input('path') : '';
		if($old) {
			if(file_exists(public_path($old))) {
				unlink(public_path($old));
			}
		}
		
		$music = $request->file('music');
		
		//判断是否上传了音频文件
		if(!$music->isValid()) {
			$data['sta'] = false;
			$data['msg'] = '上传内容不合法!';
			echo json_encode($data);
			return;
		}
		
		//获取音频文件大小
		$data['size'] = $music->getClientSize();
		
		//判断音频文件是否是指定的格式
		$allowExt = Config::get('common.music_types');
		$ext = $music->getClientOriginalExtension();
		if(!in_array($ext,$allowExt)) {
			$data['sta'] = false;
			$data['msg'] = '不支持此类型音频文件上传!';
			echo json_encode($data);
			return;
		}
		
		//判断是否有上传目录
		$dir = date('Y-m-d' , time());
		$save_path = public_path('uploads/musics/'.$dir);
		if(!file_exists($save_path)) {
			mkdir(public_path('uploads/musics/'.$dir) , 0777);
		}
		
		//生成随机名称，上传文件
		$name = time() . $this->mrand() .'.'. $music->getClientOriginalExtension();
		$sql_path = '/uploads/musics/' . $dir . '/' . $name;
		$music -> move($save_path , $name);
		$data['path'] = $sql_path;
		
		//获取文件时长
		$getID3 = new \getID3;
		$fileinfo = $getID3->analyze($save_path.'/'.$name);
		$data['duration'] = $fileinfo['playtime_seconds'] ? $fileinfo['playtime_seconds'] : 0;
		
		echo json_encode($data);
	}
	 
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$music = Resource::withTrashed()->find($id);
		
		return view('admin.music.show')->with(compact('music'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categories = Category::find(2);
		$music = Resource::find($id);
		
		return view('admin.music.edit')->with(compact('categories' , 'music'));
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
			['title'=>'required','content'=>'required','author'=>'required'],
			['title.required'=>'标题不能为空!','content.required'=>'介绍不能为空!','author.required'=>'作者不能为空!']
		);
		
		$id = $request->input('id');
		$music = Resource::find($id);
		
		//判断有没有上传图片
		if($request->hasFile('cover')) {
			
			//删除上次的图片
			$old_cover = public_path($music->cover);
			if(file_exists($old_cover)) {
				unlink($old_cover);
			}
			
			$cover = $request->file('cover');
			if($cover->isValid()) {
				$mine = $cover->getMimeType();
				switch($mine) {
					case "image/png":
						$ext = '.png';
						break;
					case "image/jpeg":
						$ext = '.jpg';
						break;
					default:
						return back()->withInput()->with('notify_error' , '图片类型不符合要求!');
				}
				$name = time() . $this->mrand() . $ext;
				$save_path = public_path('uploads/musics/' . date('Y-m-d' , time()));
				if(!file_exists($save_path)) {
					mkdir($save_path , 0777);
				}
				$sql_path = '/uploads/musics/' . date('Y-m-d' , time()) . '/' . $name;
				//保存图片
				$cover->move($save_path , $name);
				$music->cover = $sql_path;
			}	
		}
		$music->author = $request->input('author');
		$music->content = $request->input('content');
		$music->title  = $request->input('title');
		$music->category_id  = $request->input('category_id');
		if(!$music->save()) {
			return back()->withInput()->with('notify_error' , '修改失败!');
		}
		$this->record('update',$id,2);
		return redirect('donkey/admin/music/index')->with('notify_success','修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Resource::destroy($id)) {
			return back()->withInput()->with('notify_error' , '删除失败!');
		}
		$this->record('delete',$id,2);
		return back()->with('notify_success' , '删除成功!');
	}
	
	/**
	 *	随机名字
	 */
	public function mrand($num = 6) 
	{
		$str = 'ABCEDFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$name = '';
		for($i=0; $i<$num; $i++) {
			$name .= $str[mt_rand(0,61)];
		}
		return $name;
 	}
	
	/**
	 *
	 * 回收站
	 */
	public function recycle(Request $request)
	{
		$musics = Resource::onlyTrashed()->orderBy('created_at','desc')->where('type_id' , 2);
		
		//搜索
		$name = $request->input('name') ? $request->input('name') : '';
		if($name) {
			$musics = $musics->where('title' , 'like' , '%'.$name.'%');
		}
		
		$musics = $musics->paginate(10);
		return view('admin.music.recycle')->with(compact('musics','name'));
	}
	
	/**
	 * 恢复回收站内容
	 *
	 */
	public function restore($id) 
	{
		if(!Resource::onlyTrashed()->find($id)->restore()) {
			return back()->with('notify_error' , '恢复失败!');
		}
		return redirect('donkey/admin/music/index')->with('notify_success','恢复成功!');
	}
	
	/**
	 *	删除内容
	 *
	 */
	public function delete($id)
	{
		$music = Resource::onlyTrashed()->find($id);
		
		$cover = $music->cover;
		if(file_exists(public_path($cover))) {
			unlink(public_path($cover));
		}
		
		$path = $music->path;
		if(file_exists(public_path($path))){
			unlink(public_path($path));
		}
		
		//TODO 删除评论
		
		$music->forceDelete();
		return back()->with('notify_success','删除成功!');
 	}	
}
