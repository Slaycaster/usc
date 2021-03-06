<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefTarget extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_targets';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryTarget', 'FebruaryTarget', 'MarchTarget', 'AprilTarget', 'MayTarget', 'JuneTarget', 
						   'JulyTarget', 'AugustTarget', 'SeptemberTarget', 'OctoberTarget', 'NovemberTarget', 'DecemberTarget',
						   'TargetDate', 'TargetPeriod', 'Termination','ChiefMeasureID', 'ChiefAccomplishmentID', 'ChiefOwnerID', 'ChiefInitiativeID', 'ChiefFundingID','ChiefID','UserChiefID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'ChiefTargetID';

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function user_chief()
	{
		return $this->belongsTo('App\UserChief','UserChiefID','UserChiefID'); //(model, foreign_key, parent_primary_key)
	}
	
	public function chief_measure()
	{
		return $this->belongsTo('App\ChiefMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}

	public function chief_accomplishment()
	{
		return $this->belongsTo('App\ChiefAccomplishment', 'ChiefAccomplishmentID', 'ChiefAccomplishmentID');
	}

	public function chief_owner()
	{
		return $this->belongsTo('App\ChiefOwner', 'ChiefOwnerID', 'ChiefOwnerID');
	}

	public function chief_initiative()
	{
		return $this->belongsTo('App\ChiefInitiative', 'ChiefInitiativeID', 'ChiefInitiativeID');
	}

	public function chief_funding()
	{
		return $this->belongsTo('App\ChiefFunding', 'ChiefFundingID', 'ChiefFundingID');
	}


}
