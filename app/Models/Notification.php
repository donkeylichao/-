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
	
	public function resource()
	{
		return $this->belongsTo("App\Models\Resource");
	}
	
	public function album()
	{
		return $this->belongsTo("App\Models\Album");
	}
}
