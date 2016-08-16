<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resources', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->comment('发布内容的用户id');
			$table->integer('category_id')->comment('所属栏目id');
			$table->tinyInteger('type_id')->comment('类型图片，视频，音频，文字');
			$table->string('title')->comment('标题');
			$table->text('content')->comment('内容');
			$table->string('cover')->nullable()->comment('列表显示图片');
			$table->string('path')->nullable()->comment('文件上传路径');
			$table->integer('duration')->nullable()->comment('时长');
			$table->integer('size')->nullable()->comment('资源大小');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resources');
	}

}
