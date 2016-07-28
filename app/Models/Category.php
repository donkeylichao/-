<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Datebase\Eloquent\SoftDeletes;

class Category extends Model {

	//
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

}
