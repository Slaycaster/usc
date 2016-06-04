<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnit extends Model {

	protected $table = 'secondary_units';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitName', 'SecondaryUnitAbbreviation', 'PicturePath', 'UnitID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitID';

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'UnitID', 'UnitID');
	}

	public function secondary_unit_objectives()
	{
		return $this->hasMany('App\SecondaryUnitObjective', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function user_secondary_units()
	{
		return $this->hasMany('App\UserSecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_measures()
	{
		return $this->hasMany('App\SecondaryUnitMeasure', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_audit_trails()
	{
		return $this->hasMany('App\AuditTrails', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_targets()
	{
		return $this->hasMany('App\SecondaryUnitTarget', 'SecondaryUnitID', 'SecondaryUnitID');
	}
	
	public function secondary_unit_accomplishments()
	{
		return $this->hasMany('App\SecondaryUnitAccomplishment', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_owners()
	{
		return $this->hasMany('App\SecondaryUnitOwner', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function secondary_unit_initiatives()
	{
		return $this->hasMany('App\SecondaryUnitInitiative', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function unit_fundings()
	{
		return $this->hasMany('App\UnitFunding', 'UnitID', 'UnitID');
	}
	

}
