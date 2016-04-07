<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_logs', function(Blueprint $table)
		{
			$table->increments('UserLogID');
			$table->integer('UnitUserID');
			$table->dateTime('LogDateTime');
			$table->string('LogType');
			$table->string('IPAddress');
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
		Schema::drop('user_logs');
	}

}
