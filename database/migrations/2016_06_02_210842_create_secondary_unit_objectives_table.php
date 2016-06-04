<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitObjectivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_objectives', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitObjectiveID');
			$table->string('SecondaryUnitObjectiveName')->unique();
			$table->integer('PerspectiveID');
			$table->integer('SecondaryUnitID');
			$table->integer('UserSecondaryUnitID');
			$table->integer('UnitObjectiveID');
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
		Schema::drop('secondary_unit_objectives');
	}

}
