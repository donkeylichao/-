<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pdf;
use Auth,Input;
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
		$pdfs = Pdf::where("pid","<>",0);
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
		return redirect("donkey/admin/pdf/index")->with("notify_success","添加成功!");
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

}
