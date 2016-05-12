<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChief extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_chiefs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserChiefBadgeNumber', 'UserChiefFirstName', 'UserChiefMiddleName', 'UserChiefLastName', 'UserChiefQualifier', 'UserChiefPicturePath', 'UserChiefPassword', 'RankID', 'StaffID', 'UserChiefIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserChiefID';


	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function chief_measures()
	{
		return $this->hasMany('App\ChiefMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}

	public function chief_objectives()
	{
		return $this->hasMany('App\ChiefObjective', 'ChiefObjectiveID', 'ChiefObjectiveID');
	}

	public function chief_targets()
	{
		return $this->hasMany('App\ChiefTarget', 'ChiefTargetID', 'ChiefTargetID');
	}

	public function chief_accomplishments()
	{
		return $this->hasMany('App\ChiefAccomplishment', 'ChiefAccomplishmentID', 'ChiefAccomplishmentID');
	}

	public function chief_owners()
	{
		return $this->hasMany('App\ChiefOwner', 'ChiefOwnerID', 'ChiefOwnerID');
	}

	public function chief_initiatives()
	{
		return $this->hasMany('App\ChiefInitiative', 'ChiefInitiativeID', 'ChiefInitiativeID');
	}

	public function chief_fundings()
	{
		return $this->hasMany('App\ChiefFunding', 'ChiefFundingID', 'ChiefFundingID');
	}

}
