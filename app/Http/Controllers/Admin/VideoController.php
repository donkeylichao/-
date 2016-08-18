<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\VideoRequest;
use App\Models\Category;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Resource;
use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Config;

class VideoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$videos = Resource::where('type_id' , 1)->with('category')->orderBy('created_at','desc');
		$name = Input::get('name');
		
		//搜索
		if($name) {
			$videos = $videos->where('title','like','%' . $name . '%');
		} 
		
		$videos = $videos->paginate(10);
		
		return view('admin.video.index')->with(compact('videos','name'));
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
		$author = rtrim($request->input('author'));//作者
        $size = $request->input('size');//视频大小
		
		//视频，封面公共名字部分
        $name = time().$this->nrand();

        //创建文件夹用来存放上传文件
        $dirname = date('Y-m-d' , time());
        if(!is_dir(base_path('public/uploads/videos/'.$dirname))) {
            mkdir(base_path('public/uploads/videos/'.$dirname,0777));
        }

        //获取图片
        $cover = $request->file('cover');
		
		//$size = $cover->getClientSize();//视频大小
        
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
            $resource->cover = '/uploads/videos/'.$dirname.'/'.$name_cover;
        }
		
        $resource->title = $title;
        $resource->content = $content;
		$resource->path = $path;
		$resource->duration = $duration;
		$resource->size = $size;
		$resource->category_id = $category_id;
		$resource->type_id = 1;
		$resource->user_id = Auth::user()->id;
		$resource->author = $author;
		
		if(!$resource->save()) {
			return back()->withInput()->with('notify_error' , '添加失败!');
		}
		
		$id = Resource::where('path' , $path)->first()->id;
		
		//这里是添加提示消息
		$this->record('create',$id,1);
		
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
		
		//获取上传视频的大小
		$data['size'] = $video->getClientSize();
		
		//判断上传类型
		$arrExt = Config::get('common.video_types');
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
		$video = Resource::withTrashed()->where('id',$id)->first();
		return view('admin.video.show')->with(compact('video'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$video = Resource::find($id);
		//id=1表示是视频的大类
		$categories = Category::find(1);
		return view('admin.video.edit')->with(compact('video','categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$this->validate($request,
			['title'=>'required','content'=>'required','author'=>'required'],
			['title.required'=>'题目不能为空!','content.required'=>'内容不能为空!','author.required'=>'作者不能为空!']
		);
		
		$resource = Resource::find($request->input('id'));
		
		$file = $request->file('cover');
		if($file != null) {	
			if($file->isValid()) { 
				//判断有没有文件夹
				$date = date('Y-m-d',time());
				$mime = $file->getMimeType();
				//判断上传图片类型
				switch($mime) {
					case "image/jpeg":
						$ext = '.jpg';
						break;
					case "image/png":
						$ext = '.png';
						break;
					default:
						return back()->withInput()->with('notify_error','图片类型不符!');
				}
				$name = time().$this->nrand().$ext;
				$cover = "/uploads/videos/".$date.'/'.$name;
				$upload_path = public_path('uploads/videos/'.$date);
			
				//判断目录是否
				if(!file_exists($upload_path)) {
					mkdir($upload_path,0777);
				}
				$file->move($upload_path,$name);
				
				//删除原来的那个图片
				$old_cover = public_path(ltrim($resource->cover),'/');
				$old_exists = file_exists($old_cover);
				if($old_exists) {
					unlink($old_cover);
				}
				$resource->cover = $cover;
			}
		}
		$resource->title = $request->input('title');
		$resource->content = $request->input('content');
		$resource->author = $request->input('author');
		 
		if(!$resource->save()) {
			return back()->withInput()->with('notify_error','修改失败!');
		}
		
		//记录信息
		$this->record('update',$request->input('id'),1);
		return redirect('donkey/admin/video/index')->with('notify_success' , '修改成功!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!Resource::destroy($id)){
			return back()->with('notify_error' , '删除失败!');
		}
		
		$this->record('delete' , $id , 1);
		return back()->with('notify_success' , '删除成功!');
	}
	
	/**
	 *	回收站列表
	 *
	 */
	public function recycle()
	{
		$name = Input::get('name');
		
		$videos = Resource::where('type_id' , 1)->onlyTrashed()->orderBy('deleted_at' , 'desc');
		
		if($name) {
			$videos = $videos->where('title','like','%'.$name.'%');
		}
		
		$videos = $videos->paginate(10);
		
		return view('admin.video.recycle')->with(compact('videos','name'));
	}
	
	/**
	 *	回收站恢复
	 */
	public function restore($id)
	{
		$resource = Resource::onlyTrashed()->where('id' , $id)->first();
		if(!$resource->restore()) {
			return back()->with('notify_error' , '恢复失败!');
		}
		
		return back()->with('notify_success' , '恢复成功!');
	}
	
	/**
	 *	回收站里删除
	 *	
	 */
	public function delete($id)
	{
		$resource = Resource::withTrashed()->find($id);
		$cover = public_path(ltrim($resource->cover,'/'));
		//删除封面图片文件
		if(file_exists($cover)) {
			if(!unlink($cover)) {
				return back()->with('notify_error' , '删除图片文件失败!');
			}
		}
		//删除视频文件
		$path = public_path(ltrim($resource->path , '/'));
		if(file_exists($path)) {
			if(!unlink($path)) {
				return back()->with('notify_error' , '删除音频文件失败!');
			}
		}
		
		//TODO 删除所有的评论
		
		
		//从数据库删除
		$resource->forceDelete();
		return back()->with('notify_success' , '删除成功!');
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
