<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resource_id')->comment('资源的id');
			$table->char('ip',20)->comment('浏览人的ip');
			$table->timestamps();
			$table->comment = '被浏览次数表';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scans');
	}

}
