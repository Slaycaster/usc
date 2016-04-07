<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitObjectivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_objectives', function(Blueprint $table)
		{
			$table->increments('UnitObjectiveID');
			$table->string('UnitObjectiveName')->unique();
			$table->integer('PerspectiveID');
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
		Schema::drop('unit_objectives');
	}

}
