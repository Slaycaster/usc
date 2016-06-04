<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_units', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitID');
			$table->string('TertiaryUnitName')->unique();
			$table->string('TertiaryUnitAbbreviation')->unique();
			$table->string('PicturePath');
			$table->integer('SecondaryUnitID');
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
		Schema::drop('tertiary_units');
	}

}
