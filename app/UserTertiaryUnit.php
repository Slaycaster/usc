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
	protected $hidden = array('UserTertiaryBadgeNumber', 'UserTertiaryPassword');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserTertiaryBadgeNumber', 'UserTertiaryFirstName', 'UserTertiaryMiddleName', 'UserTertiaryLastName', 'UserTertiaryQualifier', 'UserTertiaryPicturePath', 'UserTertiaryPassword', 'RankID', 'TertiaryID', 'TertiaryUserIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserTertiaryID';


	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary()
	{
		return $this->belongsTo('App\Tertiary', 'TertiaryID', 'TertiaryID');
	}

	//FOREIGN ITO NG KABILANG TABLE
	public function tertiary_objectives()
	{
		return $this->hasMany('App\TertiaryObjective', 'TertiaryObjectiveID', 'TertiaryObjectiveID');
	}

	public function tertiary_measures()
	{
		return $this->hasMany('App\TertiaryMeasure', 'TertiaryMeasureID', 'TertiaryMeasureID');
	}

	public function user_logs()
	{
		return $this->hasMany('App\UserLog', 'UserTertiaryID', 'UserTertiaryID');
	}

	public function audit_trails()
	{
		return $this->hasMany('App\AuditTrail', 'UserTertiaryID', 'UserTertiaryID');
	}

	public function tertiary_targets()
	{
		return $this->hasMany('App\TertiaryTarget', 'TertiaryTargetID', 'TertiaryTargetID');
	}

	public function tertiary_accomplishments()
	{
		return $this->hasMany('App\TertiaryAccomplishment', 'TertiaryAccomplishmentID', 'TertiaryAccomplishmentID');
	}

	public function tertiary_owners()
	{
		return $this->hasMany('App\TertiaryOwner', 'TertiaryOwnerID', 'TertiaryOwnerID');
	}

	public function tertiary_initiatives()
	{
		return $this->hasMany('App\TertiaryInitiative', 'TertiaryInitiativeID', 'TertiaryInitiativeID');
	}

	public function tertiary_fundings()
	{
		return $this->hasMany('App\TertiaryFunding', 'TertiaryFundingID', 'TertiaryFundingID');
	}

}
