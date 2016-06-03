<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_units', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitID');
			$table->string('SecondaryUnitName')->unique();
			$table->string('SecondaryUnitAbbreviation')->unique();
			$table->string('PicturePath');
			$table->integer('UnitID');
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
		Schema::drop('secondary_units');
	}

}
