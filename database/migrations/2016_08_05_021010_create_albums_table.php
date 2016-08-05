<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('相册名称')->nullable();
			$table->string('descript')->comment('相册描述')->nullable();
			$table->integer('user_id')->comment('上传或者创建相册的人id');
			$table->integer('pid')->comment('相册的id')->default(0);
			$table->string('path')->nullable()->comment('照片的路径');
			$table->softDeletes();
			$table->timestamps();
			$table->comment = '相册和相册图片表，是一个无线分类';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}

}
