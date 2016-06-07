<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryAuditTrail extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'secondary_audit_trails';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Action', 'UserSecondaryUnitID', 'SecondaryUnitID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitAuditTrailID';


	public function user_secondary()
	{
		return $this->belongsTo('App\UserSecondaryUnit', 'UserSecondaryUnitID', 'UserSecondaryUnitID');
	}

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

}
