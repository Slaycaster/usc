<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryAuditTrail extends Model {

	
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
	protected $fillable = ['Action', 'UserTertiaryUnitID', 'TertiaryUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryUnitAuditTrailID';


	public function user_tertiary()
	{
		return $this->belongsTo('App\UserTertiaryUnit', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

}
