<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnitFunding extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_unit_fundings';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TertiaryUnitFundingEstimate', 'TertiaryUnitFundingActual', 'TertiaryUnitFundingDate', 'TertiaryUnitMeasureID', 'TertiaryUnitID','TertiaryUserUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'TertiaryUnitFundingID';

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function user_tertiary_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit','UserTertiaryUnitID','UserTertiaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary_unit_measure()
	{
		return $this->belongsTo('App\TertiaryUnitMeasure', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_target()
	{
		return $this->hasOne('App\TertiaryUnitTarget', 'TertiaryUnitTargetID', 'TertiaryUnitTargetID'); //(model, foreign_key, parent_primary_key)
	}

}
