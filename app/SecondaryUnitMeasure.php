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


	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit','SecondaryUnitID','SecondaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function user_secondary_unit()
	{
		return $this->belongsTo('App\UserSecondaryUnit', 'UserSecondaryUnitID', 'UserSecondaryUnitID');
	}

	public function secondary_unit_objective()
	{
		return $this->belongsTo('App\SecondaryUnitObjective', 'SecondaryUnitObjectiveID', 'SecondaryUnitObjectiveID');
	}

	public function unit_measure()
	{
		return $this->belongsTo('App\UnitMeasure', 'UnitMeasureID', 'UnitMeasureID');
	}

	

}
