<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model {

	//
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	//public $timestamps = false;
	/*public function setCreatedAtAttribute($value)
	{
		return date('Y-m-d H:i:s',$value);
	}*/
	//protected $guraded = ['created_at' , 'updated_at'];
	
	public function getSizeAttribute($value)
	{
		$size = round($value / pow(1024,2) , 1).'MB';
		return $size;
	}
	
	public function getDurationAttribute($value)
	{
		$minute = ceil($value / 60) . '分';
		$second = $value % 60 . '秒';
		return $minute.$second;
	}
	
	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}
	
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
