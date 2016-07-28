<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Datebase\Eloquent\SoftDeletes;

class Resource extends Model {

	//
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

}
