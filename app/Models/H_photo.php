<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class H_photo extends Model {
	
	protected $table = 'h_photos';
	protected $fillable = [
		'house_id','path'
	];
	
	public function house()
	{
		return $this->belongsTo('App\Models\House');
	}
}
