<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefOwnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_owners', function(Blueprint $table)
		{
			$table->increments('ChiefOwnerID');
			$table->string('ChiefOwnerContent');
			$table->date('ChiefOwnerDate');
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
		Schema::drop('chief_owners');
	}

}
