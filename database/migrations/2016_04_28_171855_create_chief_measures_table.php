<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_measures', function(Blueprint $table)
		{
			$table->increments('ChiefMeasureID');
			$table->string('ChiefMeasureName')->unique();
			$table->string('ChiefMeasureType');
			$table->string('ChiefMeasureFormula');
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
		Schema::drop('chief_measures');
	}

}
