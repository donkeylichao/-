<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Route;
use URL;
use Config;

class AuthAdmin {
	
	protected $auth;
	
	/**
	 * 创建一个新的筛选实例
	 *
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$previoursUrl = URL::previous();
		if($this->auth->guest()){
			if($request->ajax()){
				return response()->json(
					[
						'status' => 0,
						'code' => 401,
						'message' => '没有操作权限'
					]
				);
			}else {
				return redirect()->guest('donkey/admin/auth/login');
			}
		}
		//后台操作的权限验证
		if(!Auth::user()->can(Route::currentRouteName()) && (Auth::user()->id != 1)){
			if($request->ajax()){
				return response()->json(
					[
						'status' => 0,
						'code' => 401,
						'message' => '没有操作权限。'
					]
				);
			}else {
				return view('errors.401',compact('previousUrl'));
			}
		}
		return $next($request);
	}

}
