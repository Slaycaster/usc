<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitFunding extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_fundings';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitFundingEstimate', 'UnitFundingActual', 'UnitFundingDate', 'UnitMeasureID', 'UnitID','UserUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'UnitFundingID';

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'UnitID', 'UnitID');
	}

	public function user_unit()
	{
		return $this->belongsTo('App\UserUnit','UserUnitID','UserUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function unit_measure()
	{
		return $this->belongsTo('App\UnitMeasure', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_target()
	{
		return $this->hasOne('App\UnitTarget', 'UnitTargetID', 'UnitTargetID'); //(model, foreign_key, parent_primary_key)
	}

}
