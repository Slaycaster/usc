<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTertiaryUnit extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_tertiary_units';

	/**
	 * The attributes that must be hidden from query. //Slaycaster
	 *
	 * @var array
	 */
	protected $hidden = array('UserTertiaryUnitBadgeNumber', 'UserTertiaryUnitPassword');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserTertiaryUnitBadgeNumber', 'UserTertiaryUnitFirstName', 'UserTertiaryUnitMiddleName', 'UserTertiaryUnitLastName', 'UserTertiaryUnitQualifier', 'UserTertiaryUnitPicturePath', 'UserTertiaryUnitPassword', 'RankID', 'TertiaryID', 'TertiaryUserIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserTertiaryUnitID';


	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	//FOREIGN ITO NG KABILANG TABLE
	public function tertiary_unit_objectives()
	{
		return $this->hasMany('App\TertiaryUnitObjective', 'TertiaryUnitObjectiveID', 'TertiaryUnitObjectiveID');
	}

	public function tertiary_unit_measures()
	{
		return $this->hasMany('App\TertiaryUnitMeasure', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function user_logs()
	{
		return $this->hasMany('App\UserLog', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function audit_trails()
	{
		return $this->hasMany('App\AuditTrail', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function tertiary_unit_targets()
	{
		return $this->hasMany('App\TertiaryUnitTarget', 'TertiaryUnitTargetID', 'TertiaryUnitTargetID');
	}

	public function tertiary_unit_accomplishments()
	{
		return $this->hasMany('App\TertiaryUnitAccomplishment', 'TertiaryUnitAccomplishmentID', 'TertiaryUnitAccomplishmentID');
	}

	public function tertiary_unit_owners()
	{
		return $this->hasMany('App\TertiaryUnitOwner', 'TertiaryUnitOwnerID', 'TertiaryUnitOwnerID');
	}

	public function tertiary_unit_initiatives()
	{
		return $this->hasMany('App\TertiaryUnitInitiative', 'TertiaryUnitInitiativeID', 'TertiaryUnitInitiativeID');
	}

	public function tertiary_unit_fundings()
	{
		return $this->hasMany('App\TertiaryUnitFunding', 'TertiaryUnitFundingID', 'TertiaryUnitFundingID');
	}

}
