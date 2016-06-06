<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitOwnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_owners', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitOwnerID');
			$table->string('TertiaryUnitOwnerContent');
			$table->date('TertiaryUnitOwnerDate');
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
		Schema::drop('tertiary_unit_owners');
	}

}
