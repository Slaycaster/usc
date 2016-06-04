<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_audit_trails';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Action', 'TertiaryUserUnitID', 'TertiaryUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryAuditTrailID';


	public function user_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnit');
	}

}
