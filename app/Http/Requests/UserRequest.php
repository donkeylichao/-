<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

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
			'email'=>'email|unique:users' ,
			'username'=>'required|max:15' ,
			'password'=>'required|min:8',
			'real_name'=>'max:4',
			'phone'=>'max:11'
		];
	}
	
	/**
	 * 自定义的错误消息
	 *
	 */
	public  function messages()
	{
		return [
			'username.required'=>'用户名称不能为空!',
			'email.email'=>'邮箱的格式不对!',
			'email.unique'=>'邮箱已被注册!',
			'username.max'=>'用户名称不能大于6个字!',
			'password.required'=>'密码不能为空!',
			'password.min'=>'密码不能少于8个字符!',
			'real_name.max'=>'真实姓名不能大于四个字!',
			'phone.max'=>'手机号不超过11位!',
		];
	}
}
