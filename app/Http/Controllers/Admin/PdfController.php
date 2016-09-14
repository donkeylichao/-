<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pdf;
use Auth,Input,DB;
use App\Commands\Word2Pdf;

use Illuminate\Http\Request;

class PdfController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$compact = [];
		$pdfs = Pdf::where("pid","<>",0)->orderBy("created_at","desc");
		$title = Input::get('title');
		$compact[] = 'title';
		if($title) {
			$pdfs = $pdfs->where("title","like","%".$title."%");
		}
		$pdfs = $pdfs->paginate(10);
		$compact[] = 'pdfs';
		return view('admin.pdf.index')->with(compact($compact));
	}

	/**
	 * 添加分类
	 *
	 */
	public function create_type()
	{
		return view('admin.pdf.create_type');
	}
	
	/**
	 * 保存分类
	 *
	 */
	public function store_type(Request $request)
	{
		$title = rtrim($request->input('title'));
		if(!$title) {
			return back()->withInput()->with('notify_error','分类名称不能为空!');
		}
		$pdf = new Pdf;
		$pdf->title = $title;
		$pdf->pid = 0;
		if(!$pdf->save()) {
			return back()->withInput()->with('notify_error','添加失败!');
		}
		return redirect("donkey/admin/pdf/type_index")->with("notify_success","添加成功!");
	}
	
	/**
	 * 分类类表
	 *
	 */
	public function type_index()
	{
		$lists = Pdf::where("pid",0)->get();
		
		return view("admin.pdf.type_index")->with("lists",$lists);
	}
	
	/**
	 * 修改分类名称
	 *
	 */
	public function type_update()
	{
		$id = Input::get('id');
		$pdf = Pdf::find($id);
		$title = rtrim(Input::get('title'));
		
		$pdf->title = $title;
		if(!$pdf->save()) {
			return response()->json(['message'=>'failure']);
		}
		return response()->json(['message'=>'success']);
	}
	
	/**
	 * 删除分类
	 *
	 */
	public function destroy_type($id)
	{
		$type = Pdf::find($id);
		$child = $type->childs;
		if(count($child) > 0){
			return back()->with("notify_error","该分类下有内容，不能删除!");
		}
		$type->forceDelete();
		return back()->with("notify_success","删除成功!");
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$compact = [];
		$types = Pdf::where("pid",0)->get();
		$compact[] = 'types';
		
		return view('admin.pdf.create')->with(compact($compact));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dump($request->all());
		$data = [];
		
		$title = $request->input('title');
		$data['title'] = $title;
		
		$pid = $request->input('pid');
		$data['pid'] = $pid;
		//dd($request->file('file'));
		
		$user_id = Auth::user()->id;
		$data['user_id'] = $user_id;
		
		$created_at = date("Y-m-d H:i:s",time());
		$updated_at = date("Y-m-d H:i:s",time());
		$data['created_at'] = $created_at;
		$data['updated_at'] = $updated_at;
		
		if($request->hasFile('file') && $request->file('file')->isValid()) {
			$file = $request->file('file');
			$mimetype = $file->getMimeType();
			//dd($mimetype);
			if($mimetype != "application/msword") {
				return back()->withInput()->with("notify_error","上传文件格式不对，只能上传word文档!");
			}
			$name = time().$this->new_name().".doc";
			//上传文件
			$dirname = date("Y-m-d",time());
			$upload_path = public_path('uploads/words/'.$dirname);
			if(!is_dir($upload_path)) {
				mkdir($upload_path,0777);
			}
			$file->move($upload_path,$name);
			$path = "/uploads/words/".$dirname.'/'.$name;
			$data['path'] = $path;
			$id = DB::table('pdfs')->insertGetId($data);
			
			//添加word2pdf队列任务
			$this->dispatch(new Word2Pdf($id));
			return redirect("donkey/admin/pdf/index")->with("notify_success","添加成功!");
		}
		return back()->withInput()->with("notify_error","上传文件不存在或者上传错误!");
	}
	
	public function new_name($length=6)
	{
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$name = '';
		for($i=0;$i<$length;$i++){
			$name .= $str[mt_rand(0,61)];
		}
		return $name;
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pdf = Pdf::find($id);
		return view("admin.pdf.show")->with("pdf",$pdf);
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
		if(!Pdf::destroy($id)) {
			return back()->with("notify_error","删除失败!");
		}
		return back()->with("notify_success","删除成功!");
	}
	
	/**
	 * 回收站
	 *
	 */
	public function recycle(Request $request)
	{
		$title = $request->input("title");
		$pdfs = Pdf::onlyTrashed()->where("pid","<>",0);
		if($title) {
			$pdfs = $pdfs->where("title","like","%".$title."%");
		}
		$pdfs = $pdfs->paginate(10);
		
		$compact = [];
		$compact[] = 'title';
		$compact[] = 'pdfs';
		
		return view("admin.pdf.recycle")->with(compact($compact));
	}
	
	/**
	 * 恢复回收站的内容
	 *
	 */
	public function restore($id)
	{
		$pdf = Pdf::onlyTrashed()->find($id);
		if(!$pdf->restore()) {
			return back()->with("notify_error","文件恢复失败!");
		} 
		return back()->with("notify_success","文件恢复成功!");
	}
	
	/**
	 *  delete彻底删除
	 *
	 */
	public function delete($id)
	{
		$pdf = Pdf::onlyTrashed()->find($id);
		$filepath = public_path($pdf->path);
		
		if(file_exists($filepath)) {
			unlink($filepath);
		}
		
		$pdf->forceDelete();
		return back()->with("notify_success","删除成功!");
	}
}
