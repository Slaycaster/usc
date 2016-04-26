<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefObjectivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_objectives', function(Blueprint $table)
		{
			$table->increments('ChiefObjectiveID');
			$table->string('ChiefObjectiveName');
			$table->integer('PerspectiveID');
			$table->integer('ChiefID');
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
		Schema::drop('chief_objectives');
	}

}
