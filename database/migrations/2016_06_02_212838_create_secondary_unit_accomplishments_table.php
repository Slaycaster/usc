<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitAccomplishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_accomplishments', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitAccomplishmentID');
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
			$table->integer('SecondaryUnitMeasureID');
			$table->integer('SecondaryUnitID');
			$table->integer('UserSecondaryUnitID');
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
		Schema::drop('secondary_unit_accomplishments');
	}

}
