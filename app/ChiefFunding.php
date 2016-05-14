<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefFunding extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_fundings';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefFundingEstimate', 'ChiefFundingActual', 'ChiefFundingDate', 'ChiefMeasureID', 'ChiefID','UserChiefID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'ChiefFundingID';

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

	

	public function chief_target()
	{
		return $this->hasOne('App\ChiefTarget', 'ChiefTargetID', 'ChiefTargetID'); //(model, foreign_key, parent_primary_key)
	}
}
