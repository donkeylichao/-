<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex($category = 1)
	{
		$compact = [];
		$categories = Post::where('pid',0)->get();
		$compact[] = 'categories';
		
		$posts = Post::where('pid',$category)->orderBy('created_at','desc')->paginate(14);
		$compact[] = 'posts';
		
		$category = Post::find($category);
		$compact[] = 'category';
		
		return view('home.post.index')->with(compact($compact));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getShow($category,$id)
	{
		$compact = []; 
		$post = Post::find($id);
		$compact[] = 'post';
		
		$category = Post::find($category);
		$compact[] = 'category';
		
		return view('home.post.show')->with(compact($compact));
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
