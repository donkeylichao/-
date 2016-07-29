<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->comment('用户的id')->nullable();
			$table->text('body')->comment('消息内容');
			$table->integer('from_id')->comment('产生消息的用户');
			$table->tinyInteger('is_read')->default(0)->comment('是否被查看');
	
			$table->timestamps();
			$table->comment = '提示信息表';
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}

}
