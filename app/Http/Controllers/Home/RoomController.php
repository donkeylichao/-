<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Category;
use Input;

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
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex($type = 1)
	{
		$rooms = House::where("h_type" , $type)->groupBy("recommend")->paginate(10);
		//$rooms = House::all();
		$compact = [];
		$compact[] = "rooms";
		$compact[] = "type";
		//dd($rooms);
		return view("home.room.index")->with(compact($compact));
	}
	
	public function getShow($type , $id)
	{
		echo $id;
	}
}
