<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnitTarget extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_unit_targets';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryTarget', 'FebruaryTarget', 'MarchTarget', 'AprilTarget', 'MayTarget', 'JuneTarget', 
						   'JulyTarget', 'AugustTarget', 'SeptemberTarget', 'OctoberTarget', 'NovemberTarget', 'DecemberTarget',
						   'TargetDate', 'TargetPeriod','Termination', 'TertiaryUnitMeasureID','TertiaryUnitAccomplishmentID', 'TertiaryUnitOwnerID', 'TertiaryUnitInitiativeID', 'TertiaryUnitFundingID', 'TertiaryUnitID','UserTertiaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'TertiaryUnitTargetID';

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function user_tertiary_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit','UserTertiaryUnitID','UserTertiaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary_unit_measure()
	{
		return $this->belongsTo('App\TertiaryUnitMeasure', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_accomplishment()
	{
		return $this->belongsTo('App\TertiaryUnitAccomplishment', 'TertiaryUnitAccomplishmentID', 'TertiaryUnitAccomplishmentID');
	}

	public function tertiary_unit_owner()
	{
		return $this->belongsTo('App\TertiaryUnitOwner', 'TertiaryUnitOwnerID', 'TertiaryUnitOwnerID');
	}

	public function tertiary_unit_initiative()
	{
		return $this->belongsTo('App\TertiaryUnitInitiative', 'TertiaryUnitInitiativeID', 'TertiaryUnitInitiativeID');
	}

	public function tertiary_unit_funding()
	{
		return $this->belongsTo('App\TertiaryUnitFunding', 'TertiaryUnitFundingID', 'TertiaryUnitFundingID');
	}

}
