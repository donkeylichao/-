<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class HouseRequest extends Request {

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
			'name' => 'required',
			'position' => 'required',
			'room_name' => 'required',
			'type' => 'required',
			'area' => 'required',
			'price' => 'required',
			'introduction' => 'required',
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => '小区名称不能为空!',
			'position.required' => '小区位置不能为空!',
			'room_name.required' => '房子名称不能为空!',
			'type.required' => '户型不能为空!',
			'area.required' => '面积不能为空!',
			'price.required' => '价格不能为空!',
			'introduction.required' => '备注不能为空!',
		];
	}

}
