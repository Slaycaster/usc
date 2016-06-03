<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_fundings', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitFundingID');
			$table->string('SecondaryUnitFundingEstimate');
			$table->string('SecondaryUnitFundingActual');
			$table->date('SecondaryUnitFundingDate');
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
		Schema::drop('secondary_unit_fundings');
	}

}
