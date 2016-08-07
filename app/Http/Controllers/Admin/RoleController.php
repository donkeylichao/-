<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;

class RoleController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $compact = [];
        $roles = Role::paginate(10);
        $compact[] = 'roles';

        return view('admin.role.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.role.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request ,['name'=>'required|unique:roles' , 'description'=>'required'],
            ['name.required'=>'角色名称必须!','name.unique'=>'用户名称已存在!','description.required'=>'说明不能为空!']
        );

        $role = New Role;
        $role->name = rtrim($request->input('name'));
        $role->display_name = rtrim($request->input('display_name'));
        $role->description = $request->input('description');

        if(!$role->save()) {
            return back()->withInput()->with('notify_error' , '添加失败!');
        }
        return redirect('donkey/admin/role')->with('notify_success' , '添加成功!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $compact = [];

        $permissions = Permission::all();
        $role = Role::find($id);
        $role_perms = Role::find($id)->perms()->get();
        //dump($role_perms);
        $role_per = [];

        foreach($role_perms as $k=>$v) {
            $role_per[] = $v->id;
        }

        $compact[] = 'permissions';
        $compact[] = 'role';
        $compact[] = 'role_per';
        //dump($role_per);

        return view('admin.role.role_per')->with(compact($compact));
	}


    /**
     * Store the role's edit.
     *
     *
     */
    public function store_role(Request $request)
    {
        $role = Role::find($request->id);
        //dump($request->all());
        $result = $role->perms()->sync($request->permission);
        if(!$result) {
            return back()->withInput()->with('notify_error' , '修改失败!');
        }
        return redirect('donkey/admin/role')->with('notify_success' , '修改成功!');
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $role = Role::find($id);
		return view('admin.role.edit')->with('role',$role);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
        $validate = Validator::make($request->all(),['name'=>'required' , 'description'=>'required'],
            ['name.required'=>'角色名称不能为空!','description.required'=>'角色描述不能为空!']
        );
        if($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $role = Role::find($request->id);
        $role->name = rtrim($request->input('name'));
        $role->display_name = rtrim($request->input('display_name'));
        $role->description = $request->input('description');

        if(!$role->save()) {
            return back()->withInput()->with('notify_error' , '修改失败!');
            }

        return redirect('donkey/admin/role')->with('notify_success' , '修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Role::destroy($id)) {
            return back()->with('notify_error' , '删除失败!');
        }
        return back()->with('notify_success' , '删除成功!');
	}

}
