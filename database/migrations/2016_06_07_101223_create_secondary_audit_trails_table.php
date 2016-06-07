<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryAuditTrailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secondary_audit_trails', function(Blueprint $table)
		{
			$table->increments('SecondaryUnitAuditTrailID');
			$table->string('Action');
			$table->integer('UserSecondaryUnitID');
			$table->integer('SecondaryUnitID');
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
		Schema::drop('secondary_audit_trails');
	}

}
