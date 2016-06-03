<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSecondaryUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_secondary_units', function(Blueprint $table)
		{
			$table->increments('UserSecondaryUnitID');
			$table->string('UserSecondaryUnitBadgeNumber')->unique();
			$table->string('UserSecondaryUnitFirstName');
			$table->string('UserSecondaryUnitMiddleName');
			$table->string('UserSecondaryUnitLastName');
			$table->string('UserSecondaryUnitQualifier');
			$table->string('UserSecondaryUnitPicturePath');
			$table->string('UserSecondaryUnitPassword');
			$table->integer('RankID');
			$table->integer('SecondaryUnitID');
			$table->boolean('UserSecondaryUnitIsActive');
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
		Schema::drop('user_secondary_units');
	}

}
