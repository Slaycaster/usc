<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_measures', function(Blueprint $table)
		{
			$table->increments('UnitMeasureID');
			$table->string('UnitMeasureName')->unique();
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
		Schema::drop('unit_measures');
	}

}
