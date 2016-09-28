<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pdf extends Model {

	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function user()
	{
		return $this->belongsTo("App\Models\User");
	}

	public function area()
	{
		return $this->belongsTo("App\Models\Pdf","pid","id");
	}
	
	public function childs()
	{
		return $this->hasMany("App\Models\Pdf","pid","id");
	}
	
	public function parent()
	{
		return $this->belongsTo("App\Models\Pdf","pid","id");
	}
}
