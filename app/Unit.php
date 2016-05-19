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
		return $this->hasMany('App\UserUnit', 'UnitID', 'UnitID');
	}

	public function unit_objectives()
	{
		return $this->hasMany('App\UnitObjective', 'UnitID', 'UnitID');
	}

	public function unit_measures()
	{
		return $this->hasMany('App\UnitMeasure', 'UnitID', 'UnitID');
	}

	public function unit_audit_trails()
	{
		return $this->hasMany('App\AuditTrails', 'UnitID', 'UnitID');
	}

	public function unit_targets()
	{
		return $this->hasMany('App\UnitTarget', 'UnitID', 'UnitID');
	}
	
	public function unit_accomplishments()
	{
		return $this->hasMany('App\UnitAccomplishment', 'UnitID', 'UnitID');
	}

	public function unit_owners()
	{
		return $this->hasMany('App\UnitOwner', 'UnitID', 'UnitID');
	}

	public function unit_initiatives()
	{
		return $this->hasMany('App\UnitInitiative', 'UnitID', 'UnitID');
	}

	public function unit_fundings()
	{
		return $this->hasMany('App\UnitFunding', 'UnitID', 'UnitID');
	}

}
