<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavourCount extends Model {

	protected $fillable = ['comment_id','ip','choices'];

}
