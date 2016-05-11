<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitInitiativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_initiatives', function(Blueprint $table)
		{
			$table->increments('UnitInitiativeID');
			$table->string('UnitInitiativeContent');
			$table->date('UnitInitiativeDate');
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
		Schema::drop('unit_initiatives');
	}

}
