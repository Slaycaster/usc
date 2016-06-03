<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnitMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_unit_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TertiaryUnitMeasureName', 'TertiaryUnitMeasureType','TertiaryUnitMeasureFormula', 'TertiaryUnitObjectiveID','SecondaryUnitMeasureID','TertiaryUnitID', 'UserTertiaryUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryUnitMeasureID';


	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit','TertiaryUnitID','TertiaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function user_tertiary_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function tertiary_unit_objective()
	{
		return $this->belongsTo('App\TertiaryUnitObjective', 'TertiaryUnitObjectiveID', 'TertiaryUnitObjectiveID');
	}

	public function secondary_unit_measure()
	{
		return $this->belongsTo('App\SecondaryUnitMeasure', 'SecondaryUnitMeasureID', 'SecondaryUnitMeasureID');
	}

	public function tertiary_unit_targets()
	{
		return $this->hasMany('App\TertiaryUnitTarget', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_accomplishments()
	{
		return $this->hasMany('App\TertiaryUnitAccomplishment', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_owners()
	{
		return $this->hasMany('App\TertiaryUnitOwner', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_initiatives()
	{
		return $this->hasMany('App\TertiaryUnitInitiative', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_fundings()
	{
		return $this->hasMany('App\TertiaryUnitFunding', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}


}
