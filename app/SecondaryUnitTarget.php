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
						   'TargetDate', 'TargetPeriod','Termination', 'SecondaryUnitMeasureID','SecondaryUnitAccomplishmentID', 'SecondaryUnitOwnerID', 'SecondaryUnitInitiativeID', 'SecondaryUnitFundingID', 'UnitID','UserUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitTargetID';

}
