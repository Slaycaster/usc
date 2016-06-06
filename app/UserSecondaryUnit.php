<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSecondaryUnit extends Model {

	protected $table = 'user_secondary_units';

	/**
	 * The attributes that must be hidden from query. //Slaycaster
	 *
	 * @var array
	 */
	protected $hidden = array('UserSecondaryUnitBadgeNumber', 'UserSecondaryUnitPassword');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserSecondaryUnitBadgeNumber', 'UserSecondaryUnitFirstName', 'UserSecondaryUnitMiddleName', 'UserSecondaryUnitLastName', 'UserSecondaryUnitQualifier', 'UserSecondaryUnitPicturePath', 'UserSecondaryUnitPassword', 'RankID', 'SecondaryUnitID', 'UserSecondaryUnitIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserSecondaryUnitID';


	//FOREIGN KEYS

	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_measures()
	{
		return $this->hasMany('App\SecondaryUnitMeasure', 'SecondaryUnitMeasureID','SecondaryUnitMeasureID');
	}

	public function secondary_unit_objectives()
	{
		return $this->hasMany('App\SecondaryUnitObjective', 'SecondaryUnitObjectiveID', 'SecondaryUnitObjectiveID');
	}

	public function user_logs()
	{
		return $this->hasMany('App\UserLog', 'UserSecondaryUnitID', 'UserSecondaryUnitID');
	}

	public function audit_trails()
	{
		return $this->hasMany('App\AuditTrail', 'UserSecondaryUnitID', 'UserSecondaryUnitID');
	}

	public function secondary_unit_targets()
	{
		return $this->hasMany('App\SecondaryUnitTarget', 'SecondaryUnitTargetID', 'SecondaryUnitTargetID');
	}

	public function secondary_unit_accomplishments()
	{
		return $this->hasMany('App\SecondaryUnitAccomplishment', 'SecondaryUnitAccomplishmentID', 'SecondaryUnitAccomplishmentID');
	}

	public function secondary_unit_owners()
	{
		return $this->hasMany('App\SecondaryUnitOwner', 'SecondaryUnitOwnerID', 'SecondaryUnitOwnerID');
	}

	public function secondary_unit_initiatives()
	{
		return $this->hasMany('App\SecondaryUnitInitiative', 'SecondaryUnitInitiativeID', 'SecondaryUnitInitiativeID');
	}

	public function secondary_unit_fundings()
	{
		return $this->hasMany('App\SecondaryUnitFunding', 'SecondaryUnitFundingID', 'SecondaryUnitFundingID');
	}



}
