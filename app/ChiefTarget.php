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
						   'TargetDate', 'TargetPeriod', 'ChiefMeasureID', 'ChiefID','UserID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
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

	public function chief_measures()
	{
		return $this->hasMany('App\ChiefMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}

}
