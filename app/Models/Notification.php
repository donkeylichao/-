<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	/**
	 * 获取产生消息的用户
	 *
	 */
	public function user() 
	{
		return $this->belongsTo('App\Models\User');
	}
}
