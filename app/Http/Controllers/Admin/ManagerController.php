<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Admin\BaseController;

use Illuminate\Http\Request;
use App\Models\User;
use Input;
use Redirect;
use Session;
use Auth;

class ManagerController extends  BaseController{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$users = User::where('is_admin',1);
		$compact = [];
		
		if(Input::get('username')) {
			$username = rtrim(Input::get('username'));
			$users = $users->where('name','like',"%$username%")->paginate(10);
		}else{
			$username = '';
			$users = $users->paginate(10);
		}
		
		$compact[] = 'username';
		$compact[] = 'users';
		
		//dump(compact($compact));
		return view('admin.manager.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.manager.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		//获取所有数据并处理
		$username = rtrim($request->input('username'));
		$password = rtrim($request->input('password'));
		$email = rtrim($request->input('email'));
		$phone = rtrim($request->input('phone'));
		$real_name = rtrim($request->input('real_name'));
		
		//创建user实例
		$user = new User;
		$user->name = $username;
		$user->email = $email;
		$user->password = bcrypt($password);
		$user->phone = $phone;
		$user->real_name = $real_name;
		$user->is_admin = 1;
		
		//保存实例
		if(!$user->save()){
			return Redirect::to('donkey/admin/manager/create')->withInput()->with('notify_error','添加失败!');
		}	
		return Redirect::to('donkey/admin/manager')->with('notify_success','添加成功!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$compact = [];
		$compact[] = 'user';
		return view('admin.manager.edit')->with(compact($compact));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$this->validate($request,['username'=>'required|max:15','password'=>'required|min:8','phone'=>'max:11','real_name'=>'max:4'],
		['username.required'=>'用户名称必须!',
		'username.max'=>'用户名称长度不能超过15!',
		'password.required'=>'密码不能为空!',
		'password.min'=>'密码不能少于8位!',
		'phone.max'=>'手机号不超过11位!',
		'real_name.max'=>'真实姓名不能超过4个字!'
		]);
		
		$user = User::find($request->input('id'));
		$user->name = rtrim($request->input('username'));
		$user->password = bcrypt(rtrim($request->input('password')));
		$user->phone = rtrim($request->input('phone'));
		$user->real_name = rtrim($request->input('real_name'));
		
		if(!$user->save()){ 
			return back()->with('notify_error' , '修改失败!');
		}
		return Redirect::to('donkey/admin/manager')->with('notify_success', '用户' . $user->name . '修改成功！');
	} 

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!User::destroy($id)){
			return back()->with('notify_error' , '删除失败!');
		}
		return back()->with('notify_success' , '删除成功!');
	}

}
