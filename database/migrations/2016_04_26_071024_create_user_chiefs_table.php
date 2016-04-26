<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChiefsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_chiefs', function(Blueprint $table)
		{
			$table->increments('UserChiefID');
			$table->string('UserChiefBadgeNumber')->unique();
			$table->string('UserChiefFirstName');
			$table->string('UserChiefMiddleName');
			$table->string('UserChiefLastName');
			$table->string('UserChiefQualifier');
			$table->string('UserChiefPicturePath');
			$table->string('UserChiefPassword');
			$table->integer('RankID');
			$table->integer('ChiefID');
			$table->boolean('UserChiefIsActive');
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
		Schema::drop('user_chiefs');
	}

}
