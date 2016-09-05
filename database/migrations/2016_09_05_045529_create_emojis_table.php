<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmojisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emojis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment("表情名称");
			$table->string('mark')->comment("表情标记");
			$table->string('path')->comment('图片路径');
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
		Schema::drop('emojis');
	}

}
