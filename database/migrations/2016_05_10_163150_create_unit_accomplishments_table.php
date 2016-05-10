<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitAccomplishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_accomplishments', function(Blueprint $table)
		{
			$table->increments('UnitAccomplishmentID');
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
			$table->integer('UnitMeasureID');
			$table->integer('UnitID');
			$table->integer('UserUnitID');
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
		Schema::drop('unit_accomplishments');
	}

}
