<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitInitiativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_initiatives', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitInitiativeID');
			$table->string('SecondaryUnitInitiativeContent');
			$table->date('SecondaryUnitInitiativeDate');
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
		Schema::drop('secondary_unit_initiatives');
	}

}
