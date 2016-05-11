<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_fundings', function(Blueprint $table)
		{
			$table->increments('StaffFundingID');
			$table->string('StaffFundingEstimate');
			$table->string('StaffFundingActual');
			$table->date('StaffFundingDate');
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
		Schema::drop('staff_fundings');
	}

}
