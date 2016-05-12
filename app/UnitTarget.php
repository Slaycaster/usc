<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitTarget extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_targets';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryTarget', 'FebruaryTarget', 'MarchTarget', 'AprilTarget', 'MayTarget', 'JuneTarget', 
						   'JulyTarget', 'AugustTarget', 'SeptemberTarget', 'OctoberTarget', 'NovemberTarget', 'DecemberTarget',
						   'TargetDate', 'TargetPeriod','Termination', 'UnitMeasureID', 'UnitID','UserUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'UnitTargetID';

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

}
