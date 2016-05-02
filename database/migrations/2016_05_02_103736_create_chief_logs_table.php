<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_logs', function(Blueprint $table)
		{
			$table->increments('ChiefLogID');
			$table->integer('ChiefUserID');
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
		Schema::drop('chief_logs');
	}

}
