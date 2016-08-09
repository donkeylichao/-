<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\House;
use App\Models\H_photo;
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
		$room = House::with('photos')->find($id);
	
		return view('admin.room.show')->with(compact('room'));
	}
	
	/**
	 * 图片上传
	 *
	 */
	public function upload(Request $request)
	{
		//dump($request->all());
		//dump($request->file('picture'));
		//echo app_path('public/rooms/');
		//echo $this->rands();
		
		$id = $request->input('id');
		
		//先判断是否有目录
		$path_name = $this->isset_path();
		$pic = $request->file('picture');
		foreach ($pic as $item) {
			if(!$item->isValid()) {
				return back()->withInput()->with('notify_error' , '图片不存在');
			} 
			$mime_type = $item->getMimeType();
			switch($mime_type) {
				case "image/jpeg":
					$ext = '.jpeg';
					break;
				case "image/png":
					$ext = '.png';
					break;
				case "image/jpg":
					$ext = '.jpg';
					break;
				default:
					return back()->withInput()->with('notify_error' , '图片必须是jpg,jpeg,png类型!');
			}
			
			$file_name = time().$this->rands().$ext;
			$item->move($path_name[0],$file_name);
			$path = $path_name[1].'/'.$file_name;
			$result = H_photo::create(['house_id'=>$id , 'path'=>$path]); 
			if(!$result) {
				return back()->withInput()->with('notify_error' , '上传失败!');
			}
		}
		return back()->withInput()->with('notify_success' , '上传成功!');
	}
	
	/**
	 * 判断目录是否存在不存在则生成目录，存在不管。
	 *
	 */
	private function isset_path()
	{
		$name = date('Y-m-d',time());
		$path_name = [];
		$path_name[] = base_path('public/uploads/rooms/'.$name);
		$path_name[] = '/uploads/rooms/'.$name;
		if(!is_dir($path_name[0])) {
			mkdir($path_name[0]);
		}
		return $path_name;
	}
	
	/**
	 *	生成随机的文件名称
	 *
	 */
	private function rands()
	{
		$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		//dump($str);
		$file_name = '';
		for($i=0;$i<=5;$i++) {
			$file_name = $file_name.$str[mt_rand(0,61)];
		}
		return $file_name;
	}
	 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$room = House::find($id);
		$compact = [];
		$compact[] = 'room';
		
		return view('admin.room.edit')->with(compact($compact));
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(HouseRequest $request)
	{
		//dump($request->all());
		$room = House::find($request->id);
		$preUrl = 'donkey/admin/room/index/' . $request->input('h_type'); 
		
		if($request->input('h_type') == 2) {
			$univalence = $request->input('univalence');
			if(!$univalence) {
				return back()->withInput()->with('notify_error' , '单价不能为空!');
			}
			$room->univalence = $univalence;
			$taxes = $request->input('taxes');
			if(!$taxes) {
				return back()->withInput()->with('notify_error' , '税费不能为空!');
			} 
			$room->taxes = $taxes;
		}
		
		$room->name = $request->input('name');
		$room->position = $request->input('position');
		$room->room_name = $request->input('room_name');
		$room->type = $request->input('type');
		$room->area = $request->input('area');
		$room->price = $request->input('price');
		$room->introduction = $request->input('introduction');
		
		if(!$room->save()) {
			return back()->withInput()->with('notify_error' , '修改失败!');
		}
		return redirect($preUrl)->with('notify_success' , '修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//TODO
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
	
	/**
	 *	删除图片
	 * 
	 */
	public function del_pic($id) 
	{
		//TODO
	}
}
