<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_unit_targets', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitTargetID');
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
			$table->integer('SecondaryUnitMeasureID');
			$table->integer('SecondaryUnitAccomplishmentID');
			$table->integer('SecondaryUnitOwnerID');
			$table->integer('SecondaryUnitInitiativeID');
			$table->integer('SecondaryUnitFundingID');
			$table->integer('SecondaryUnitID');
			$table->integer('UserSecondaryUnitID');
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
		Schema::drop('secondary_unit_targets');
	}

}
