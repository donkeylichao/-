<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Word;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class Word2Pdf extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
	
	protected $word_id;
	protected $startOpenofficeExc = 'soffice -headless -accept="socket,host=127.0.0.1,port=8100;urp;" -nofirststartwizard';
	protected $openoffice = public_path('');
	protected $jodconverter = public_path('');
	protected $javaPath = '';
	protected $pdf2swf = '';
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($word_id)
	{
		$this->word_id = $word_id;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$word = Word::find($this->word_id);
		//获取word文件
		$wordfile = public_path($word->path);
		//新文件保存名称
		$newname = str_replace(".doc",".pdf",$word->path);
		//$filename = pathinfo($wordfile,PATHINFO_FILENAME);
		$outname = str_replace(".doc",".pdf",$wordfile);
		$p = "java -jar". $jodconverPath.' '.$wordfile.' '.$outname,$out,$status;
		exec($p);
		//删除word文档
		if($status === 0) {
			$word->path = $newname;
			if(!$word->save()){
				echo "false";
			} else {
				echo "success"
			}
			if(file_exists($wordfile)) {
				unlink($wordfile);
			}
		}else {
			$this->handle();
		}
	}
}
