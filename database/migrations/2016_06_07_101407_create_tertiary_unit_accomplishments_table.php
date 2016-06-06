<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitAccomplishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_accomplishments', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitAccomplishmentID');
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
			$table->integer('TertiaryUnitMeasureID');
			$table->integer('TertiaryUnitID');
			$table->integer('UserTertiaryUnitID');
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
		Schema::drop('tertiary_unit_accomplishments');
	}

}
