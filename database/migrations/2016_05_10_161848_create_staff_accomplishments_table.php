<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffAccomplishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_accomplishments', function(Blueprint $table)
		{
			$table->increments('StaffAccomplishmentID');
			$table->float('JanuaryAccomplishment');
			$table->float('FebruaryAccomplishment');
			$table->float('MarchAccomplishment');
			$table->float('AprilAccomplishment');
			$table->float('MayAccomplishment');
			$table->float('JuneAccomplishment');
			$table->float('JulyAccomplishment');
			$table->float('AugustAccomplishment');
			$table->float('SeptemberAccomplishment');
			$table->float('OctoberAccomplishment');
			$table->float('NovemberAccomplishment');
			$table->float('DecemberAccomplishment');
			$table->date('AccomplishmentDate');
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
		Schema::drop('staff_accomplishments');
	}

}
