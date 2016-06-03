<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitMeasure extends Model {

	//
	protected $table = 'secondary_unit_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitMeasureName', 'SecondaryUnitMeasureType','SecondaryUnitMeasureFormula', 'SecondaryUnitObjectiveID','UnitMeasureID','SecondaryUnitID', 'UserSecondaryUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitMeasureID';

}
