<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\Guard;

class AppAdmin {

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
		$userObj = $request->user(); 
		//后台操作时的管理员身份验证
		if((!is_null($userObj) && $userObj->is_admin == 1) || (!is_null($userObj) && $userObj->id == 1)){
			$userObj->last_login_ip = get_client_ip();
			$userObj->save();
			return $next($request);
		} else {
			$this->auth->logout();
		}
		return new RedirectResponse(url('donkey/admin/auth/login'));
	}

}
