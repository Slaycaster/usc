<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'units';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitName', 'UnitAbbreviation', 'PicturePath', 'StaffID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UnitID';


	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

	public function user_units()
	{
		return $this->hasMany('App\UserUnit', 'UserUnitID', 'UserUnitID');
	}

	public function unit_objectives()
	{
		return $this->hasMany('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

	public function unit_measures()
	{
		return $this->hasMany('App\UnitMeasure', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function unit_audit_trails()
	{
		return $this->hasMany('App\AuditTrails', 'AuditTrailID', 'AuditTrailID');
	}

}
