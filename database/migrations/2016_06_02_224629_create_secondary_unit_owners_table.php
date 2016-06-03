<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitOwnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_owners', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitOwnerID');
			$table->string('SecondaryUnitOwnerContent');
			$table->date('SecondaryUnitOwnerDate');
			$table->integer('SecondaryUnitMeasureID');
			$table->integer('SecondaryUnitID');
			$table->integer('UserSecondaryUnitID');
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
		Schema::drop('secondary_unit_owners');
	}

}
