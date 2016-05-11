<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_fundings', function(Blueprint $table)
		{
			$table->increments('UnitFundingID');
			$table->string('UnitFundingEstimate');
			$table->string('UnitFundingActual');
			$table->date('UnitFundingDate');
			$table->integer('UnitMeasureID');
			$table->integer('UnitID');
			$table->integer('UserUnitID');
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
		Schema::drop('unit_fundings');
	}

}
