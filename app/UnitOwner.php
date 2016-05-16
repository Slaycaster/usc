<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitOwner extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_owners';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitOwnerContent', 'UnitOwnerDate', 'UnitMeasureID', 'UnitID','UserUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'UnitOwnerID';

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