<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notifications', function(Blueprint $table)
		{
			$table->dropColumn('from_id');
			$table->integer('resource_id')->nullable()->comment('视频，音频id');
			$table->integer('album_id')->nullable()->comment('相册的id');
			$table->tinyInteger('type')->comment('资源类型');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notifications', function(Blueprint $table)
		{
			$table->dropColumn('resource_id');
			$table->dropColumn('album_id');
			$table->dropColumn('type');
		});
	}

}
