<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Permission;
use Illuminate\Http\Request;
use Validator;

class PermissionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$compact = [];
		$permissions = Permission::paginate(10);
		$compact[] = 'permissions';
		
		return view('admin.permission.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.permission.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,['name'=>'required|unique:permissions','description'=>'required'],
			['name.required'=>'权限名称必须!','name.unique'=>'权限名称已存在','description.required'=>'说明必须写!']);
		
		$permission = new Permission;
		$permission->name = rtrim($request->input('name'));
		$permission->display_name = rtrim($request->input('display_name'));
		$permission->description = rtrim($request->input('description'));
		$permission->type = $request->input('type');
		
		if(!$permission->save()) {
			return back()->withInput()->with('notify_error' , '添加失败!');
		}
		return redirect('donkey/admin/permission')->with('notify_success', '添加成功!');
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
		$permission = Permission::find($id)->toArray();
		
		$compact = [];
		$compact[] = 'permission';
		//dump($permission['name']);
		return view('admin.permission.edit')->with(compact($compact));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(),
			['name'=>'required','description'=>'required'],
			['name.required'=>'权限名称必须!','description.required'=>'说明必须!']
		);
		
		if($validator->fails()){
			return back()->withErrors($validator);
		}
		
		$permission = Permission::find($request->input('id'));
		$permission->name = rtrim($request->input('name'));
		$permission->display_name = rtrim($request->input('display_name'));
		$permission->description = rtrim($request->input('description'));
		$permission->type = $request->input('type');
		
		if(!$permission->save()) {
			return back()->with('notify_error' , '修改失败!');
		}
		return redirect('donkey/admin/permission')->with('notify_success' , '修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Permission::destroy($id)) {
			return back()->with('notify_error' , '删除失败!');
		}
		return redirect('donkey/admin/permission')->with('notify_success' , '删除成功!');
	} 

}
