<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitObjectivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_objectives', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitObjectiveID');
			$table->string('TertiaryUnitObjectiveName')->unique();
			$table->integer('PerspectiveID');
			$table->integer('TertiaryUnitID');
			$table->integer('UserTertiaryUnitID');
			$table->integer('SecondaryUnitObjectiveID');
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
		Schema::drop('tertiary_unit_objectives');
	}

}
