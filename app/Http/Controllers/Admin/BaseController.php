<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller {
	
	const PAGE_NUM = 10;
	public function  __construct()
	{
		$this->middleware('auth.admin');
	}
	
}
