<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Pdf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class Word2Pdf extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
	
	protected $run = 'off';
	protected $word_id;
	protected $startOpenofficeExc = 'soffice -headless -accept="socket,host=127.0.0.1,port=8100;urp;" -nofirststartwizard';
	//protected $openoffice = "C:/Program Files (x86)/OpenOffice 4/program";
	//protected $jodconverter = public_path('/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar');
	protected $jodconverter = "D:/xampp/htdocs/donkeyli/public/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar";
	//protected $javaPath = '';
	//protected $pdf2swf = '';
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
		$word = Pdf::find($this->word_id);
		//获取word文件
		$wordfile = public_path($word->path);
		//新文件保存名称
		/*if(strpos($wordfile,'.docx')) {
			$newname = str_replace(".docx",".pdf",$word->path);
			$outname = str_replace(".docx",".pdf",$wordfile);
		} else {*/
			$newname = str_replace(".doc",".pdf",$word->path);
			$outname = str_replace(".doc",".pdf",$wordfile);
		//}
		//$filename = pathinfo($wordfile,PATHINFO_FILENAME);
		
		//$p = "java -jar". $this->jodconverter.' '.$wordfile.' '.$outname.','.$status;
		//dd($p);
		exec("java -jar $this->jodconverter $wordfile $outname",$out,$status);
		//删除word文档
		if($status === 0) {
			$word->path = $newname;
			/*if(!$word->save()){
				echo "false";
			} else {
				echo "success";
			}*/
			$word->save();
			if(file_exists($wordfile)) {
				unlink($wordfile);
			}
		}else {
			$this->handle();
		}
	}
}
