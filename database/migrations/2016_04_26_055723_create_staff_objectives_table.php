<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffObjectivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_objectives', function(Blueprint $table)
		{
			$table->increments('StaffObjectiveID');
			$table->string('StaffObjectiveName');
			$table->integer('PerspectiveID');
			$table->integer('StaffID');
			$table->integer('ChiefObjectiveID');
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
		Schema::drop('staff_objectives');
	}

}
