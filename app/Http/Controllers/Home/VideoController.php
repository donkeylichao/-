<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as FormRequest;
use App\Models\Resource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favour;
use App\Models\FavourCount;
use Cache,Request,Input;
use Config,Auth,DB;
use App\Models\Emoji;
use App\Commands\BadWord;

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
			Cache::put($key,$videos,Config::get("common.cache_time")[0]);
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
			$emojis = json_encode(Emoji::select('mark','path','name')->orderBy("created_at","desc")->get(),JSON_UNESCAPED_UNICODE);
			Cache::put("emojis",$emojis,Config::get("common.cache_time")[0]);
			return $emojis;
		});
		$compact[] = "emojis";
		
		//dd($category);
		$resource = Resource::find($id);
		/*if(empty($resource)) {
			return back()->with("notify_error" , "此视频已删除!");
		}*/
		//评论列表
		$comments = Comment::where("resource_id",$id)->where("pid",0)->orderBy("created_at","desc")->get();
		
		//评论条数
		$count = Comment::where("resource_id",$id)->count();
		
		//栏目名称
		$category_name = Category::find($category_id)->name;
		
		$compact[] = 'category_name';
		$compact[] = 'count';
		$compact[] = 'comments';
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
		
		//获取评论者id
		//$user_id = Auth::user()->id;
		//TODO
		$user_id = 1;
		//获取提交内容
		$content = rtrim($request->Input("contents"));
		$pid = $request->Input("pid");
		$resource_id = $request->Input("resource_id");
		
		//dd($content);
		/*$comment = new Comment;
		$comment->resource_id = $resource_id;
		$comment->pid = $pid;
		$comment->user_id = $user_id;
		$comment->content = $content;*/
		$data = [];
		$data['resource_id'] = $resource_id;
		$data['pid'] = $pid;
		$data['user_id'] = $user_id;
		$data['content'] = $content;
		$data['created_at'] = date("Y-m-d H:i:s",time());
		$data['updated_at'] = date("Y-m-d H:i:s",time());

		/*if(!$comment->save()) {
			return back()->withInput()->with("notify_error","添加评论失败!");
		}*/
		//$id = DB::table('comments')->insertGetId($data);
		$comment = Comment::create($data);
		$id = $comment->id;
		$job = new BadWord($id);
		$this->dispatch($job);
		if(!$id){
			return back()->withInput()->with("notify_error","添加评论失败!");
		}
		//$category_id = $request->input("category_id");
		//dd($category_id);
		//return redirect("/donkey/video/" . $category_id ."/show/" . $resource_id);
		return back()->with("notify_success","评论成功!");
	}
	
	/**
	 * 赞操作
	 */
	public function postFavour()
	{
		$comment_id = Input::get('comment_id');
		$ip = Request::ip();
		$ifDo = FavourCount::where("comment_id",$comment_id)->where("ip",$ip)->first();
		if(empty($ifDo)) {
			FavourCount::create(['comment_id'=>$comment_id,'ip'=>$ip,'choices'=>1]);
			$favour = Favour::firstOrCreate(['comment_id' => $comment_id]);
			$favour->increment("favours",1);
			return 0;
		} 
		return 1;
	}

    /**
     * 赞操作
     */
    public function postTread()
    {
        $comment_id = Input::get('comment_id');
        $ip = Request::ip();
        $ifDo = FavourCount::where("comment_id",$comment_id)->where("ip",$ip)->first();
        if(empty($ifDo)) {
            FavourCount::create(['comment_id'=>$comment_id,'ip'=>$ip,'choices'=>0]);
            $favour = Favour::firstOrCreate(['comment_id' => $comment_id]);
            $favour->increment("treads",1);
            return 0;
        }
        return 1;
    }
}
