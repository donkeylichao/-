<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\VideoRequest;
use App\Models\Category;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Resource;
use Illuminate\Http\Request;
use Auth;

class VideoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$videos = Resource::where('type_id' , 1)->with('category')->get();
		return view('admin.video.index')->with(compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$compact = [];

		$categories = Category::with('child')->find(1);
		$compact[] = 'categories';

		return view('admin.video.create')->with(compact($compact));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VideoRequest $request)
	{
        $resource = new Resource;
        //dump($request->all());
		$category_id = $request->input('category_id');//栏目
        $title = rtrim($request->input('title'));//标题
        $content = rtrim($request->input('content'));//内容
		$path = rtrim($request->input('path'));//视频存放路径
		$duration = rtrim($request->input('duration'));//视频时长
		
        //视频，封面公共名字部分
        $name = time().$this->nrand();

        //创建文件夹用来存放上传文件
        $dirname = date('Y-m-d' , time());
        if(!is_dir(base_path('public/uploads/videos/'.$dirname))) {
            mkdir(base_path('public/uploads/videos/'.$dirname,0777));
        }

        //获取图片
        $cover = $request->file('cover');
		
		$size = $cover->getClientSize();//视频大小
        
		if($cover->isValid()) {
            //dd($cover->getMimeType());
            switch($cover->getMimeType()){
                case 'image/jpeg':
                    $ext = '.jpeg';
                    break;
                case 'image/jpg':
                    $ext = '.jpg';
                    break;
                case 'image/png':
                    $ext = '.png';
                    break;
                default:
                    return back()->withInput()->with('notify_error' , '图片类型不符!');
            }
            $name_cover = $name.$ext;

            $cover->move(base_path('public/uploads/videos/'.$dirname) , $name_cover);
            $resource->cover = '/uploads/videos/'.$dirname.$name_cover;
        }
        $resource->title = $title;
        $resource->content = $content;
		$resource->path = $path;
		$resource->duration = $duration;
		$resource->size = $size;
		$resource->category_id = $category_id;
		$resource->type_id = 1;
		$resource->user_id = Auth::user()->id;
		
		if(!$resource->save()) {
			return back()->withInput()->with('notify_error' , '添加失败!');
		}
		return redirect('donkey/admin/video/index')->with('notify_success' , '添加成功!');
 
        //获取视频文件

	}

	
	/**
	 *	视屏上传
	 */
	public function uploadv(Request $request)
	{
		//删除上一次上传的视频
		$path = $request->input('path');
		if($path) {
			if(is_file(public_path($path))) {
				unlink(public_path($path));
			}
		}
		
		$video = $request->file('video');
		
		//返回的数组
		$data = ['sta'=>TRUE,'msg'=>'上传成功!'];
		
		//判断上传是否有效
		if(!$video->isValid()) {
			$data['sta'] = FALSE;
			$data['msg'] = '上传内容不合法!';
			echo json_encode($data);
			return;
		}
		
		//判断上传类型
		$arrExt = ['mp4','flv','avi','m4v'];
		if(!in_array($video->getClientOriginalExtension(),$arrExt)) {
			$data['sta'] = FAlSE;
			$data['msg'] = '不支持此类型上传!';
			echo json_encode($data);
			return;
		}
		
		//设置上传目录
		$ymd = date('Y-m-d' , time());
		$path = public_path('uploads/videos/').$ymd;
		if(!file_exists($path)) {
			mkdir($path,0777);
		}
		
		//设置文件名称
		$name = time().$this->nrand().'.'.$video->getClientOriginalExtension();
		
		//上传文件
		$video->move($path,$name);
		$data['name'] = $name;
		//获取视频时长
		$getID3 = new \getID3;
		$fileinfo = $getID3->analyze($path.'/'.$name);
		$data['duration'] = $fileinfo['playtime_seconds'] != null ? $fileinfo['playtime_seconds'] :　0;
		$data['previewSrc'] = '/uploads/videos/'.$ymd.'/'.$name;
		
		
		echo json_encode($data);
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
	 *	回收站列表
	 *
	 */
	public function recycle()
	{
		return view('admin.video.recycle');
	}
	public function restore()
	{
		return view('admin.video.restore');
	}
	
    /**
     *  随机文件名
     */
    public function nrand($num = 6)
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCEDFGHIJKLMNOPQRSTUVWXYZ1234567890';

        $name = '';
        for($i=0;$i<$num;$i++) {
            $name .=$str[mt_rand(0,61)];
        }
        return $name;
    }
}
