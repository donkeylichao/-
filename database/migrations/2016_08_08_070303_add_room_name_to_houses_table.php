<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomNameToHousesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('houses', function(Blueprint $table)
		{
			$table->string('room_name')->comment('房子的楼号及楼层房间好');
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
			$table->dropColumn('room_name');
		});
	}

}
