<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_id')->comment("评论的id");
			$table->integer('favours')->default(0)->comment("点赞的数量");
			$table->integer('treads')->default(0)->comment("踩得数量");
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
		Schema::drop('favours');
	}

}
