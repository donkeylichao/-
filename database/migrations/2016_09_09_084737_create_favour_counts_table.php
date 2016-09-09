<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavourCountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favour_counts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("comment_id")->comment("评论id");
			$table->string("ip")->comment("点过赞或踩过的ip");
			$table->enum('choices',[0,1])->comment("1是赞0是踩");
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
		Schema::drop('favour_counts');
	}

}
