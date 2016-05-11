<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefMeasureName', 'ChiefMeasureType', 'ChiefMeasureFormula', 'ChiefObjectiveID','ChiefID', 'UserChiefID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefMeasureID';
	
	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function user_chief()
	{
		return $this->belongsTo('App\UserChief','UserChiefID','UserChiefID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief_objective()
	{
		return $this->belongsTo('App\ChiefObjective','ChiefObjectiveID','ChiefObjectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief_targets()
	{
		return $this->hasMany('App\ChiefTarget','ChiefTargetID','ChiefTargetID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff_measures()
	{
		return $this->hasMany('App\StaffMeasure', 'StaffMeasureID', 'StaffMeasureID');
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
