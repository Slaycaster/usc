<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTertiariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tertiaries', function(Blueprint $table)
		{
			$table->increments('UserTertiaryID');
			$table->string('UserTertiaryBadgeNumber')->unique();
			$table->string('UserTertiaryFirstName');
			$table->string('UserTertiaryMiddleName');
			$table->string('UserTertiaryLastName');
			$table->string('UserTertiaryQualifier');
			$table->string('UserTertiaryPicturePath');
			$table->string('UserTertiaryPassword');
			$table->integer('RankID');
			$table->integer('TertiaryID');
			$table->boolean('UserTertiaryIsActive');
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
		Schema::drop('user_tertiaries');
	}

}
