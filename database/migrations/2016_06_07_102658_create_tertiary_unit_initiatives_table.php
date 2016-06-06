<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitInitiativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_initiatives', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitInitiativeID');
			$table->string('TertiaryUnitInitiativeContent');
			$table->date('TertiaryUnitInitiativeDate');
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
		Schema::drop('tertiary_unit_initiatives');
	}

}
