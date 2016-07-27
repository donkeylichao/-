<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->char('phone',11)->nullable();
			$table->tinyInteger('role_id')->default('0');
			$table->char('real_name',10)->nullable();
			$table->string('headimg')->nullable();
			$table->char('com',10)->nullable()->comment('三方登陆类型');
			$table->string('value')->nullable();
			$table->string('openid')->nullable();
			$table->char('last_login_ip',16)->nullable();
			$table->tinyInteger('is_admin')->default(0)->comment('是否是管理员');
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
		Schema::drop('users');
	}

}
