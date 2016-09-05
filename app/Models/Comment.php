<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Models\Emoji;
use DB;

class Comment extends Model {

	private function getEmojiArray() 
	{ 
		Cache::get('emojis',function(){
			$marks = DB::table("emojis")->lists("mark");
			$paths = DB::table("emojis")->lists("path");
			//$marks = array_values($marks);
			//$paths = array_values($paths);
			//dd($marks);
			$emojis_array = array_combine($marks,$paths);
			Cache::put("emojis",$emojis_array,10);
			return $emojis_array;
		});
	}
	
	public function getContentAttribute($value)
	{
		$this->getEmojiArray();
		$pattern = "/\[\/(.*?)\]/";
		//preg_match_all($pattern, $value, $result);
		//dd($result);
		$value = preg_replace_callback($pattern , function($matches){
			$emojis_array = Cache::get("emojis");
			return "<img src=".$emojis_array[$matches[0]] ."/>";
		} , $value);
		return $value;
	}
}
