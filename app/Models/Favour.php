<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favour extends Model {

    protected $fillable = ['comment_id'];

	public function comment()
	{
		return $this->belongsTo('App\Models\Comment');
	}

}
