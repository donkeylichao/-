<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Category;
use Input;
use Cache,Request;

class RoomController extends Controller {

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
		$video_types = Category::where("pid",1)->get();
		Cache::put("video_types",$video_types,10);
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex($type = 1)
	{	
		$key = Request::getUri();
		$rooms = Cache::get($key,function() use ($type,$key){
			$rooms = House::where("h_type" , $type)->orderBy("recommend","desc")->paginate(10);
			//Cache::put($key,$rooms,10);
			return $rooms;
		});
		//$rooms = House::all();
		$compact = [];
		$compact[] = "rooms";
		$compact[] = "type";
		//dd($rooms);
		return view("home.room.index")->with(compact($compact));
	}
	
	public function getShow($type , $id)
	{
		$room = House::find($id);
		if(empty($room)) {
			return back()->with("notify_error" , "此房屋消息不存在!");
		}
		$compact = [];
		$compact[] = 'room';
		return view("home.room.show")->with(compact($compact));
	}
}
