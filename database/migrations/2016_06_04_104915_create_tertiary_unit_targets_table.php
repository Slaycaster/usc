<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryUnitTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_unit_targets', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitTargetID');
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
			$table->string('Termination');
			$table->integer('TertiaryUnitMeasureID');
			$table->integer('TertiaryUnitID');
			$table->integer('UserTertiaryUnitID');
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
		Schema::drop('tertiary_unit_targets');
	}

}
