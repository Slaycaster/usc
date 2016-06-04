<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnit extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiaries';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TertiaryUnitName', 'TertiaryUnitAbbreviation', 'PicturePath', 'SecondaryID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryUnitID';


	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function user_tertiary_units()
	{
		return $this->hasMany('App\UserTertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_objectives()
	{
		return $this->hasMany('App\TertiaryUnitObjective', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_measures()
	{
		return $this->hasMany('App\TertiaryUnitMeasure', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_audit_trails()
	{
		return $this->hasMany('App\AuditTrails', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_targets()
	{
		return $this->hasMany('App\TertiaryUnitTarget', 'TertiaryUnitID', 'TertiaryUnitID');
	}
	
	public function tertiary_unit_accomplishments()
	{
		return $this->hasMany('App\TertiaryUnitAccomplishment', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_owners()
	{
		return $this->hasMany('App\TertiaryUnitOwner', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_initiatives()
	{
		return $this->hasMany('App\TertiaryUnitInitiative', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function tertiary_unit_fundings()
	{
		return $this->hasMany('App\TertiaryUnitFunding', 'TertiaryUnitID', 'TertiaryUnitID');
	}

}
