<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$categories = Category::where('pid' , 0)->with('child')->get();
		
		return view('admin.category.index')->with(compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$compact = [];
		$categories = Category::where('pid' , 0)->get();
		
		$compact[] = 'categories';
		return view('admin.category.create')->with(compact($compact));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,['name'=>'required|unique:categories,name'] , ['name.required'=>'分类名称不能为空!','name.unique'=>'分类名称已存在!']);
		
		$category = new Category;
		$category->pid = $request->input('pid');
		$category->name = rtrim($request->input('name'));
		
		if(!$category->save()) {
			return back()->withInput()->with('notify_error' , '添加分类失败!');
		}
		return redirect('donkey/admin/category')->with('notify_success' , '添加分类成功!');
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
		$category = Category::find($request->input('id'));
		
		$name = $request->input('name');
		$category->name = $name;
		
		if(!$category->save()) {
			return response()->json(['message' =>'failure']);
		}
		return response()->json(['message'=>'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		//dump($category->child->first());
		if($category->child->first() != null ) {
			return back()->with('notify_error' , '只能删除空的根分类!');
		}
		$category->forceDelete();
		return back()->with('notify_success' , '删除成功!');
	}

}
