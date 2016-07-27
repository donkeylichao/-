<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('houses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('小区名称');
			$table->string('position')->comment('小区位置');
			$table->smallInteger('area')->comment('小区面积');
			$table->string('type')->comment('户型');
			$table->integer('price')->comment('价格');
			$table->tinyInteger('h_type')->comment('房子类型,出租或二手');
			$table->integer('user_id')->comment('信息录入人');
			$table->string('photo')->comment('封面图片');
			$table->text('introduction')->comment('备注');
			$table->tinyInteger('recommend')->default(0)->comment('是否推荐');
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
		Schema::drop('houses');
	}

}
