<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use App\Models\Resource;
use App\Models\Pdf;
use App\Models\Post;
use App\Models\House;
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
		
		//房子数量
		$rooms = House::where('user_id',$user->id)->count();
		$compact[] = 'rooms';
		
		//视频数量
		$videos = Resource::withTrashed()->where('type_id',1)->where('user_id',$user->id)->count();
		$compact[] = 'videos';
		
		//音频数量
		$musics = Resource::withTrashed()->where('type_id',2)->where('user_id',$user->id)->count();
		$compact[] = 'musics';
		
		//文件数量
		$pdfs = Pdf::withTrashed()->where('user_id',$user->id)->count();
		$compact[] = 'pdfs';
		
		//日记数量
		$posts = Post::withTrashed()->where('user_id',$user->id)->count();
		$compact[] = 'posts';
		
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
		$data = [];
		$data['status'] = 0;
		$data['msg'] = '上传失败!';
		$url = $request->input('url');
		if($request->hasFile('userfile') && $request->file('userfile')->isValid()) {
			//上传图片
			$file = $request->file('userfile');
			$mime = $file->getMimeType();
			switch($mime) {
				case 'image/jpeg':
					$ext = '.jpg';
					break;
				case 'image/png':
					$ext = '.png';
					break;
				default:
					$data['msg'] = '图片类型不对';
					echo json_encode($data,JSON_UNESCAPED_UNICODE );
					return;
			}
			$newname = time().$this->name().$ext;
			$save_path = public_path('uploads/headimgs');
			$sql_path = '/uploads/headimgs/'.$newname;
			$file->move($save_path,$newname);
			
			$headimg = User::find($request->input('id'));
			$url = $headimg->headimg;
			$headimg->headimg = $sql_path;
			
			if($headimg->save()){
				$data['status'] = 1;
				$data['msg'] = '上传成功!';		
				if($url != '' && file_exists(public_path($url))) {
					unlink(public_path($url));
				}
			}
			$data['url'] = $sql_path;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE );
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
	
	private function name($num = 6) {
		$str = 'ABCEDFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$name = '';
		for($i=0;$i<$num;$i++) {
			$name .= $str[rand(0,61)];
		}
		return $name;
	}

}
