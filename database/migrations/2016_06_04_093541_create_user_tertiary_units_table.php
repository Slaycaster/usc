<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTertiaryUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tertiary_units', function(Blueprint $table)
		{
			$table->increments('UserTertiaryUnitID');
			$table->string('UserTertiaryUnitBadgeNumber')->unique();
			$table->string('UserTertiaryUnitFirstName');
			$table->string('UserTertiaryUnitMiddleName');
			$table->string('UserTertiaryUnitLastName');
			$table->string('UserTertiaryUnitQualifier');
			$table->string('UserTertiaryUnitPicturePath');
			$table->string('UserTertiaryUnitPassword');
			$table->integer('RankID');
			$table->integer('TertiaryUnitID');
			$table->boolean('UserTertiaryUnitIsActive');
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
		Schema::drop('user_tertiary_units');
	}

}
