<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTertiaryAuditTrailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tertiary_audit_trails', function(Blueprint $table)
		{
			$table->increments('TertiaryUnitAuditTrailID');
			$table->string('Action');
			$table->integer('UserTertiaryUnitID');
			$table->integer('TertiaryUnitID');
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
		Schema::drop('tertiary_audit_trails');
	}

}
