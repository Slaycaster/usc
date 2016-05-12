<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiefTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chief_targets', function(Blueprint $table)
		{
			$table->increments('ChiefTargetID');
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
		Schema::drop('chief_targets');
	}

}
