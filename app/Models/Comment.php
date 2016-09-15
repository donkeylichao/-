<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Models\Emoji;
use DB;
use Config;

class Comment extends Model {

	private function getEmojiArray() 
	{ 
		//Cache::get('emojis',function(){
			$marks = DB::table("emojis")->lists("mark");
			$paths = DB::table("emojis")->lists("path");
			//$marks = array_values($marks);
			//$paths = array_values($paths);
			//dd($marks);
			$emojis_array = array_combine($marks,$paths);
			Cache::put("emojis_array",$emojis_array,Config::get("common.cache_time")[0]);
			//return $emojis_array;
		//});
	}
	
	/*public function getContentAttribute($value)
	{
		$this->getEmojiArray();
		$pattern = "/\[\/(.*?)\]/";
		//preg_match_all($pattern, $value, $result);
		//dd($result);
		$value = preg_replace_callback($pattern , function($matches){
			$emojis_array = Cache::get("emojis_array");
			return "<img src=".$emojis_array[$matches[0]] ."/>";
		} , $value);
		return $value;
	}*/
	
	
	public function setContentAttribute($value)
	{
		//转换头像图片
		$this->getEmojiArray();
		$pattern = "/\[\/(.*?)\]/";
		//preg_match_all($pattern, $value, $result);
		//dd($result);
		//dd(Cache::get("emojis"));
		$value = preg_replace_callback($pattern , function($matches){
			$emojis_array = Cache::get("emojis_array");
			return "<img src=".$emojis_array[$matches[0]] ."/>";
		} , $value);
		
		//替换中文敏感词汇
		$chinese = Cache::get("chinese",function(){
			$chinese = Config::get("badword.chinese");
			Cache::put("chinese",$chinese,Config::get("common.cache_time")[0]);
			return $chinese;
		});

		$replace_chinese = [];
		foreach($chinese as $v) {
			$replace_chinese[] = str_repeat("*",strlen($v)/3);
		}
		$replace1 = array_combine($chinese,$replace_chinese);
		$value = strtr($value,$replace1);
		
		//退换字母敏感词汇
		$english = Cache::get("english",function(){
			$english = Config::get("badword.english");
			Cache::put("english",$english,Config::get("common.cache_time")[0]);
			return $english;
		});
		
		$replace_english = [];
		foreach($english as $v1) {
			$replace_english[] = str_repeat("*",strlen($v1));
		}
		$replace2 = array_combine($english,$replace_english);
		$value = strtr($value,$replace2);
		$this->attributes["content"] = $value; 
		//return $value;	
	}
	//子评论
	public function childs()
	{
		return $this->hasMany('App\Models\Comment',"pid","id");
	}
	
	//评论的用户
	public function user()
	{
		return $this->belongsTo("App\Models\User");
	}
	
	//赞或踩数量
	public function favour()
	{
		return $this->hasOne("App\Models\Favour");
	}

    //评论所属资源
    public function resource()
    {
        return $this->belongsTo("App\Models\Resource");
    }
}
