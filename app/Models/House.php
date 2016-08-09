<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model {

	public function photos()
	{
		return $this->hasMany('App\Models\H_photo');
	}

}
