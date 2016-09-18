<?php namespace App\Commands;

use App\Commands\Command;
use Cache,Config;
use App\Models\Comment;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class BadWord extends Command implements SelfHandling,ShouldBeQueued {

	protected $id;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($comment_id)
	{
		$this->id = $comment_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//取出评论内容
		$comment = Comment::find($this->id);
		$value = $comment->content;
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
		//写入替换后的评论内容
		$comment->content = $value;
		$comment->save();
	}

}
