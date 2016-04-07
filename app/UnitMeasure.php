<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitMeasureName', 'UnitID', 'UserUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UnitMeasureID';


	public function unit()
	{
		return $this->belongsTo('App\Unit','UnitID','UnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function user_unit()
	{
		return $this->belongsTo('App\UserUnit', 'UserUnitID', 'UserUnitID');
	}

}
