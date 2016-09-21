<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Comment;
use App\Models\Favour;
use App\Models\FavourCount;
use Illuminate\Http\Request;

class CommentController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $compact = [];

        $comments = Comment::where("pid",0)->orderBy('created_at','desc')->paginate(10);
        $compact[] = 'comments';
        return view("admin.comment.index")->with(compact($compact));
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
		$comments = Comment::find($id);
        return view('admin.comment.show')->with(compact('comments'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $comment = Comment::find($id);
        return view('admin.comment.edit')->with(compact('comment'));
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
        $comment = Comment::find($id);

        $comment->content = rtrim($request->input('content'));

        if(!$comment->save()){
            return back()->with('notify_error','修改失败!');
        }
        return redirect('donkey/admin/comment')->with('notify_success','修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		$childs = Comment::find($id)->childs;
		if(count($childs) > 0) {
			foreach($childs as $item){
				//删除踩赞数量
				Favour::where("comment_id",$item->id)->delete();
				//删除踩赞记录
				FavourCount::where("comment_id",$item->id)->delete();	
				//删除子评论
				$item->delete();
			}
		}
		
		//删除踩赞数量
		Favour::where("comment_id",$id)->delete();
		
		//删除踩赞记录
		FavourCount::where("comment_id",$id)->delete();
		
		$comment = Comment::find($id);
		if(!$comment->delete()) {
            return back()->with('notify_error','删除失败!');
        }
        return redirect('donkey/admin/comment')->with('notify_success','删除成功!');
	}

}
