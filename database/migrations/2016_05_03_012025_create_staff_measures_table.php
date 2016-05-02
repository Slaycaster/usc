<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_measures', function(Blueprint $table)
		{
			$table->increments('StaffMeasureID');
			$table->string('StaffMeasureName');
			$table->string('StaffMeasureType');
			$table->string('StaffMeasureFormula');
			$table->integer('ChiefMeasureID');
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
		Schema::drop('staff_measures');
	}

}
