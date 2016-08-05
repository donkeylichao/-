<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->comment('帖子名称或者板块名称');
			$table->text('content')->comment('帖子的内容')->nullable();
			$table->integer('user_id')->comment('创建人的id');
			$table->integer('pid')->comment('板块的id');
			$table->softDeletes();
			$table->timestamps();
			$table->comment = '日记表是一个无线分类';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
