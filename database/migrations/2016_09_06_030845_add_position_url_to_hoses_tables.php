<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionUrlToHosesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('houses', function(Blueprint $table)
		{
			$table->string("position_url")->nullable()->comment("地图路径");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('houses', function(Blueprint $table)
		{
			$table->dropColumn("position_url");
		});
	}

}
