<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_logs', function(Blueprint $table)
		{
			$table->increments('StaffLogID');
			$table->integer('StaffUserID');
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
		Schema::drop('staff_logs');
	}

}
