<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chiefs', function(Blueprint $table)
		{
			$table->increments('ChiefID');
			$table->string('ChiefName')->unique();
			$table->string('ChiefAbbreviation')->unique();
			$table->string('PicturePath');
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
		Schema::drop('chiefs');
	}

}
