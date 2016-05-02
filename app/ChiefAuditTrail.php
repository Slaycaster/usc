<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefAuditTrail extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_audit_trails';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Action', 'UserChiefID', 'ChiefID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefAuditTrailID';


	public function user_chief()
	{
		return $this->belongsTo('App\UserChief', 'UserChiefID', 'UserChiefID');
	}

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

}
