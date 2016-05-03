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
			$table->integer('JanuaryTarget');
			$table->integer('FebruaryTarget');
			$table->integer('MarchTarget');
			$table->integer('AprilTarget');
			$table->integer('MayTarget');
			$table->integer('JuneTarget');
			$table->integer('JulyTarget');
			$table->integer('AugustTarget');
			$table->integer('SeptemberTarget');
			$table->integer('OctoberTarget');
			$table->integer('NovemberTarget');
			$table->integer('DecemberTarget');
			$table->date('TargetDate');
			$table->string('TargetPeriod');
			$table->integer('ChiefMeasureID');
			$table->integer('ChiefID');
			$table->integer('UserID');
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
