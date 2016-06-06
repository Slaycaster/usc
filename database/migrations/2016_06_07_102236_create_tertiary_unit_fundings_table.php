<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_fundings', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitFundingID');
			$table->string('TertiaryUnitFundingEstimate');
			$table->string('TertiaryUnitFundingActual');
			$table->date('TertiaryUnitFundingDate');
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
		Schema::drop('tertiary_unit_fundings');
	}

}
