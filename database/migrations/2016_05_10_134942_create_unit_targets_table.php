<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_targets', function(Blueprint $table)
		{
			$table->increments('UnitTargetID');
			$table->float('JanuaryTarget');
			$table->float('FebruaryTarget');
			$table->float('MarchTarget');
			$table->float('AprilTarget');
			$table->float('MayTarget');
			$table->float('JuneTarget');
			$table->float('JulyTarget');
			$table->float('AugustTarget');
			$table->float('SeptemberTarget');
			$table->float('OctoberTarget');
			$table->float('NovemberTarget');
			$table->float('DecemberTarget');
			$table->date('TargetDate');
			$table->string('TargetPeriod');
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
		Schema::drop('unit_targets');
	}

}
