<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefInitiativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_initiatives', function(Blueprint $table)
		{
			$table->increments('ChiefInitiativeID');
			$table->string('ChiefInitiativeContent');
			$table->date('ChiefInitiativeDate');
			$table->integer('ChiefMeasureID');
			$table->integer('ChiefID');
			$table->integer('UserChiefID');
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
		Schema::drop('chief_initiatives');
	}

}
