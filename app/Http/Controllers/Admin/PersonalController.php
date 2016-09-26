<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Input,Auth;


class PersonalController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::check()){
			return redirect('/donkey/admin/auth/login');
		}
		$compact = [];
		$user = Auth::user();
		$compact[] = 'user';
		
		return view('admin.personal.index')->with(compact($compact));
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//dump($request->all());
		$user = User::find($request->input('pk'));
		$data = [];
		$data['status'] = 'error';
		$data['msg'] = '修改失败!';
		$name = $request->input('name');
		$value = rtrim($request->input('value'));
		switch($name) {
			case 'email':
				$user->email = $value;
				break;
			case 'name':
				$user->name = $value;
				break;
			case 'real_name':
				$user->real_name = $value;
				break;
			case 'phone':
				$user->phone = $value;
				break;
		}
		if($user->save()) {
			$data['status'] = 'success';
			$data['msg'] = '修改成功!';
		}
	
		return response()->json($data);
	}
	
	
	public function headimg(Request $request)
	{
		//dd($request->file('userfile'));
        echo 'true';
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
