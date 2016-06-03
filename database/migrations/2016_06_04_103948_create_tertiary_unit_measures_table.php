<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_measures', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitMeasureID');
			$table->string('TertiaryUnitMeasureName');
			$table->string('TertiaryUnitMeasureType');
			$table->string('TertiaryUnitMeasureFormula');
			$table->integer('TertiaryUnitObjectiveID');
			$table->integer('SecondaryUnitMeasureID');
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
		Schema::drop('tertiary_unit_measures');
	}

}
