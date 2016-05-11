<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_fundings', function(Blueprint $table)
		{
			$table->increments('ChiefFundingID');
			$table->string('ChiefFundingEstimate');
			$table->string('ChiefFundingActual');
			$table->date('ChiefFundingDate');
			$table->integer('ChiefMeasureID');
			$table->integer('ChiefID');
			$table->integer('UserChiefID');
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
		Schema::drop('chief_fundings');
	}

}
