<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pdfs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("title")->comment("上传文件标题");
			$table->string("path")->comment("文件保存路径");
			$table->integer("user_id")->comment("上传的用户");
			$table->integer("pid")->comment("板块的id");
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pdfs');
	}

}
