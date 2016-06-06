<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitTarget extends Model {

	protected $table = 'secondary_unit_targets';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryTarget', 'FebruaryTarget', 'MarchTarget', 'AprilTarget', 'MayTarget', 'JuneTarget', 
						   'JulyTarget', 'AugustTarget', 'SeptemberTarget', 'OctoberTarget', 'NovemberTarget', 'DecemberTarget',
						   'TargetDate', 'TargetPeriod','Termination', 'SecondaryUnitMeasureID','SecondaryUnitAccomplishmentID', 'SecondaryUnitOwnerID', 'SecondaryUnitInitiativeID', 'SecondaryUnitFundingID', 'SecondaryUnitID','UserSecondaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitTargetID';

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'UnitID');
	}

	public function user_secondary_unit()
	{
		return $this->belongsTo('App\UserSecondaryUnit','UserSecondaryUnitID','UserSecondaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function secondary_unit_measure()
	{
		return $this->belongsTo('App\SecondaryUnitMeasure', 'SecondaryUnitMeasureID', 'SecondaryUnitMeasureID');
	}

	public function secondary_unit_accomplishment()
	{
		return $this->belongsTo('App\SecondaryUnitAccomplishment', 'SecondaryUnitAccomplishmentID', 'SecondaryUnitAccomplishmentID');
	}

	public function secondary_unit_owner()
	{
		return $this->belongsTo('App\SecondaryUnitOwner', 'SecondaryUnitOwnerID', 'SecondaryUnitOwnerID');
	}

	public function secondary_unit_initiative()
	{
		return $this->belongsTo('App\SecondaryUnitInitiative', 'SecondaryUnitInitiativeID', 'SecondaryUnitInitiativeID');
	}

	public function secondary_unit_funding()
	{
		return $this->belongsTo('App\SecondaryUnitFunding', 'SecondaryUnitFundingID', 'SecondaryUnitFundingID');
	}

}
