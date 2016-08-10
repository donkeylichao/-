<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	/*public function __construct()
	{
		parent::__construct();
	}*/
	
	public function child()
	{
		return $this->hasMany('App\Models\Category' , 'pid' , 'id');
	}
}
