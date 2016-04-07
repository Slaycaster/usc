<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_units', function(Blueprint $table)
		{
			$table->increments('UserUnitID');
			$table->string('UserUnitBadgeNumber')->unique();
			$table->string('UserUnitFirstName');
			$table->string('UserUnitMiddleName');
			$table->string('UserUnitLastName');
			$table->string('UserUnitQualifier');
			$table->string('UserUnitPicturePath');
			$table->string('UserUnitPassword');
			$table->integer('RankID');
			$table->integer('UnitID');
			$table->boolean('UserUnitIsActive');
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
		Schema::drop('user_units');
	}

}
