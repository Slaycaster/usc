<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStaffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_staffs', function(Blueprint $table)
		{
			$table->increments('UserStaffID');
			$table->string('UserStaffBadgeNumber')->unique();
			$table->string('UserStaffFirstName');
			$table->string('UserStaffMiddleName');
			$table->string('UserStaffLastName');
			$table->string('UserStaffQualifier');
			$table->string('UserStaffPicturePath');
			$table->string('UserStaffPassword');
			$table->integer('RankID');
			$table->integer('StaffID');
			$table->boolean('UserStaffIsActive');
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
		Schema::drop('user_staffs');
	}

}
