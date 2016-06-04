<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_measures', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitMeasureID');
			$table->string('SecondaryUnitMeasureName');
			$table->string('SecondaryUnitMeasureType');
			$table->string('SecondaryUnitMeasureFormula');
			$table->integer('SecondaryUnitObjectiveID');
			$table->integer('UnitMeasureID');
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
		Schema::drop('secondary_unit_measures');
	}

}
