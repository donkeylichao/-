<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVoteToHousesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('houses', function(Blueprint $table)
		{
			$table->integer('univalence')->comment('买卖单价')->nullable();
			$table->decimal('tax_rate')->comment('买卖税率')->nullable();
			$table->integer('taxes')->comment('税费')->nullable();
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
			$table->dropColumn(['univalence','tax_rate','taxes']);
		});
	}

}
