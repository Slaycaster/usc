<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInitiativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_initiatives', function(Blueprint $table)
		{
			$table->increments('StaffInitiativeID');
			$table->string('StaffInitiativeContent');
			$table->date('StaffInitiativeDate');
			$table->integer('StaffMeasureID');
			$table->integer('StaffID');
			$table->integer('UserStaffID');
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
		Schema::drop('staff_initiatives');
	}

}
