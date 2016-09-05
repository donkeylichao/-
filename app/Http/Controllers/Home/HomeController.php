<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class HomeController extends Controller {

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
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//return view('home');
		/*$string = "April 15, 2014 April 16, 2017";
		$pattern = '/(\w+) (\d+), (\d+)/i';
		$replacement = '$2,$3';
		echo preg_replace($pattern,$replacement,$string);*/
		//$comments = Comment::find(1);
	
		//$comments->content;
		return view("home.index.index");
	}

}
