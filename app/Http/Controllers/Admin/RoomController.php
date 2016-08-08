<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Requests\HouseRequest;
use Input;
use Auth;

class RoomController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($type = 1)
	{	
		$rooms = House::where('h_type' , $type);
		
		//判断是否有搜索
		if(Input::get('name')) {
			$name = "%".Input::get('name')."%";
			//dump($name);
		} else {
			$name = '%%';
		}
		
		$rooms = $rooms->where('name' , 'like' , $name)->orderBy('id' , 'desc')->paginate(10);
		
		return view('admin.room.index')->with(compact('rooms','name'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.room.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(HouseRequest $request)
	{
		$house = New House;
		
		if($request->input('h_type') == 2) {
			//判断单价是否为空
			$univalence = rtrim($request->input('univalence'));
			if(!$univalence) {
				return back()->withInput()->with('notify_error','单价不能为空!');
			}
			$house->univalence = $univalence;
			//判断税费是否为空
			$taxes = rtrim($request->input('taxes'));
			if(!$taxes) {
				return back()->withInput()->with('notify_error', '税费不能为空!');
			}
			$house->taxes = $taxes;
			$house->tax_rate = rtrim($request->input('tax_rate'));
		}
		
		//获取提交信息
		$house->name = $request->input('name');
		$house->position = $request->input('position');
		$house->area = $request->input('area');
		$house->type = $request->input('type');
		$house->room_name = $request->input('room_name');
		$house->price = $request->input('price');
		$house->h_type = $request->input('h_type');
		$house->introduction = $request->input('introduction');
		$house->user_id = Auth::user()->id;
		
		//保存信息
		if(!$house->save()) {
			return back()->withInput()->with('notify_error' , '添加失败!');
		}
		return redirect('donkey/admin/room/index/1')->with('notify_success','添加成功!');
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
	public function update($id)
	{
		//
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
	
	/**
	 *	如果是推荐标记为不推荐，不是，修改为推荐
	 *
	 */
	public function recommend($id) 
	{
		$room = House::find($id);
		
		$recommend = $room->recommend ? 0 : 1;
		//dump($recommend);
		$room->recommend = $recommend;
		if(!$room->save()) {
			return back()->with('notify_error' , '修改推荐失败!');
		}
		return back()->with('notify_success' , '修改推荐成功!');
	}

}
