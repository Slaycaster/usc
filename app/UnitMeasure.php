<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitMeasureName', 'UnitMeasureType','UnitMeasureFormula', 'UnitObjectiveID','StaffMeasureID','UnitID', 'UserUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UnitMeasureID';


	public function unit()
	{
		return $this->belongsTo('App\Unit','UnitID','UnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function user_unit()
	{
		return $this->belongsTo('App\UserUnit', 'UserUnitID', 'UserUnitID');
	}

	public function unit_objective()
	{
		return $this->belongsTo('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

	public function staff_measure()
	{
		return $this->belongsTo('App\StaffMeasure', 'StaffMeasureID', 'StaffMeasureID');
	}

	public function unit_targets()
	{
		return $this->hasMany('App\UnitTarget', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_accomplishments()
	{
		return $this->hasMany('App\UnitAccomplishment', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_owners()
	{
		return $this->hasMany('App\UnitOwner', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_initiatives()
	{
		return $this->hasMany('App\UnitInitiative', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_fundings()
	{
		return $this->hasMany('App\UnitFunding', 'UnitMeasureID', 'UnitMeasureID');
	}


}
