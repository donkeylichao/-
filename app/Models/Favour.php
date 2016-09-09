<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favour extends Model {

	public function comment()
	{
		return $this->belongsTo("App\Models\Comment");
	}

}
