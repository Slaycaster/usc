<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefAccomplishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_accomplishments', function(Blueprint $table)
		{
			$table->increments('ChiefAccomplishmentID');
			$table->float('JanuaryAccomplishment');
			$table->float('FebruaryAccomplishment');
			$table->float('MarchAccomplishment');
			$table->float('AprilAccomplishment');
			$table->float('MayAccomplishment');
			$table->float('JuneAccomplishment');
			$table->float('JulyAccomplishment');
			$table->float('AugustAccomplishment');
			$table->float('SeptemberAccomplishment');
			$table->float('OctoberAccomplishment');
			$table->float('NovemberAccomplishment');
			$table->float('DecemberAccomplishment');
			$table->date('AccomplishmentDate');
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
		Schema::drop('chief_accomplishments');
	}

}
