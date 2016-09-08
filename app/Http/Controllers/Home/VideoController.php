<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as FormRequest;
use App\Models\Resource;
use App\Models\Category;
use App\Models\Comments;
use Cache,Request,Input;
use App\Models\Emoji;

class VideoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		//$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex($category_id = 0)
	{
		if($category_id == 0){
			$category_id = Category::where('pid' , 1)->first()->id;
		}
		$categories = Category::where("pid" , 1)->get();
		$compact = [];
		$compact[] = "categories";
		
		$key = Request::getUri();
		$videos = Cache::get($key,function() use ($key,$category_id){
			$videos = Resource::where("category_id" , $category_id)->paginate(10);
			Cache::put($key,$videos,10);
			return $videos;
		});
		$compact[] = "videos";
		
		$category_name = Category::find($category_id)->name;
		$compact[] = "category_name";
		
		return view("home.video.index")->with(compact($compact));
	}
	
	/**
	 *	显示某一个视频
	 */
	public function getShow($category_id,$id)
	{
		$compact = [];
		$emojis = Cache::get("emojis",function(){
			$emojis = json_encode(Emoji::select('mark','path','name')->get(),JSON_UNESCAPED_UNICODE);
			Cache::put("emojis",$emojis,10);
			return $emojis;
		});
		$compact[] = "emojis";
		
		//dd($category);
		$resource = Resource::find($id);
		if(empty($resource)) {
			return back()->with("notify_error" , "此视频已删除!");
		}

        $compact[] = 'category_id';
		$compact[] = 'resource';
		return view("home.video.show")->with(compact($compact));
	}
	
	/**
	 * 发表评论
	 *
	 */
	public function postComment(FormRequest $request)
	{
		$contents = rtrim($request->input("contents"));
		if($contents == "") {
			return back()->with("notify_error","评论内容不能为空!");
		}
		
	}
}
