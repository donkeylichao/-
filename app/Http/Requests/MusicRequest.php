<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class MusicRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required',
			'content' => 'required',
			'cover' => 'required',
			'author' => 'required',
		];
	}
	
	public function messages()
	{
		return [
			'title.required' => '标题不能为空!',
			'content.required' => '介绍不能为空!',
			'cover.required' => '封面图片不能为空!',
			'author.required' => '作者不能为空!',
		];
	}

}
