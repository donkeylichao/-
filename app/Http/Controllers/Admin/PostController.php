<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Post;
use Input,Auth;
use Illuminate\Http\Request;

class PostController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$compact = [];
		
		$posts = Post::where('pid','<>',0);
		if(Input::get('title')) {
			$title = "%".Input::get('title')."%";
			$posts->where("title","like",$title);
		}
		
		$posts = $posts->paginate(10);
		$compact[] = 'posts';
		$title = Input::get('title');
		$compact[] = 'title';
		
		return view("admin.post.index")->with(compact($compact));
	}
	
	/**
	 * 添加类别
	 *
	 */
	public function create_type()
	{
		return view('admin.post.create_type');
	}
	
	/**
	 * 保存类别
	 *
	 */
	public function store_type(Request $request)
	{
		$title = $request->input('title');
		if(!$title) {
			return back()->withInput()->with('notify_error','名称不能为空!');
		}
		$post_type = new Post;
		$post_type->title = $title;
		$post_type->pid = 0;
		if(!$post_type->save()) {
			return back()->withInput()->with('notify_error','添加失败!');
		}
		return redirect('donkey/admin/post/index')->with('notify_success','添加成功!');
	}
	
	/**
	 * type_index 类型列表
	 *
	 */
	public function type_index()
	{
		$types = Post::where("pid",0)->get();
		return view('admin.post.type_index')->with(compact("types"));
	}
	
	/**
	 * type_update 编辑分类
	 *
	 */ 
	public function type_update(Request $request)
	{
		$type = Post::find($request->input('id'));
		
		$title = $request->input('title');
		$type->title = $title;
		
		if(!$type->save()) {
			return response()->json(['message' =>'failure']);
		}
		return response()->json(['message'=>'success']);
	}
	
	/**
	 * destroy_type
	 */
	public function destroy_type($id)
	{
		$type = Post::find($id);
		if( count($type->childs) >0){
			return back()->with("notify_error","该分类不为空，不能删除!");
		}
		$type->forceDelete();
		return back()->with("notify_success","删除分类成功!");
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$types = Post::where('pid',0)->get();
		
		$compact = [];
		$compact[] = 'types';
		return view('admin.post.create')->with(compact($compact));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dd($request->all());
		$title = rtrim($request->input('title'));
		$pid = $request->input('pid');
		$content = $request->input('content');
		$user_id = Auth::user()->id; 
		
		$post = new Post;
		$post->title = $title;
		$post->pid = $pid;
		$post->content = $content;
		$post->user_id = $user_id;
		
		if(!$post->save()){
			return back()->withInput()->with('notify_error','发表失败!');
		}
		return redirect('donkey/admin/post/index')->with('notify_success','发表成功!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function show($id)
	{
		$post = Post::find($id);
		
		return view('admin.post.show')->with(compact('post'));
	}*/

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$compact = [];
		$post = Post::find($id);
		$compact[] = 'post';
		
		$types = Post::where("pid",0)->get();
		$compact[] = 'types';
		return view("admin.post.edit")->with(compact($compact));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//dd($request->all());
		$id = $request->input('id');
		$post = Post::find($id);
		
		$post->title = $request->input('title');
		$post->content = $request->input('content');
		$post->pid = $request->input('pid');
		
		if(!$post->save()) {
			return back()->withInput()->with('notify_error','修改失败!');
		}
		return redirect('donkey/admin/post/index')->with('notify_success','修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Post::destroy($id)) {
			return back()->with('notify_error','添加回收站失败!');
		}
		return back()->with('notify_success' , '添加回收站成功!');
	}
	
	/**
	 * 回收站列表
	 *
	 */
	public function recycle()
	{
		$compact = [];
		$posts = Post::onlyTrashed()->where("pid","<>",0);
		$title = Input::get('title');
		if($title) {
			$posts = $posts->where('title','like',"%".$title."%");
		}
		$compact[] = 'title';
		$posts = $posts->paginate(10);
		$compact[] = 'posts';
		
		return view('admin.post.recycle')->with(compact($compact));
	}
	
	/**
	 * 恢复回收站内容
	 *
	 */ 
	public function restore($id)
	{
		if(!Post::onlyTrashed()->where('id',$id)->restore()) {
			return back()->with('notify_error','恢复失败!'); 
		}
		return back()->with('notify_success','恢复成功!');
	}
	
	/**
	 * 彻底删除
	 *
	 */ 
	public function delete($id)
	{
		$post = Post::withTrashed()->find($id);
		$post->forceDelete();
		return back()->with("notify_success","删除成功!");
	}
}
