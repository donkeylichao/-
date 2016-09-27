<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pdf;

use Illuminate\Http\Request;

class PdfController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex($category = 1)
	{
		$compact = [];
		$categories = Pdf::where('pid',0)->get();
		$compact[] = 'categories';
			
		$pdfs = Pdf::where('pid',$category)->orderBy('created_at','desc')->paginate(14);
		$compact[] = 'pdfs';
		
		$category = Pdf::find($category);
		$compact[] = 'category';
		
		return view('home.pdf.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getShow($category,$id)
	{
		$pdf = Pdf::find($id);
		return view('home.pdf.show')->with('pdf',$pdf);
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
