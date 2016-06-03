<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitObjective extends Model {

	protected $table = 'secondary_unit_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitObjectiveName', 'PerspectiveID', 'SecondaryUnitID', 'UserSecondaryUnitID', 'UnitObjectiveID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitObjectiveID';

}
