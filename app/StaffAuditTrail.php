<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffAuditTrail extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_audit_trails';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['Action', 'UserStaffID', 'StaffID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffAuditTrailID';


	public function user_staff()
	{
		return $this->belongsTo('App\UserStaff', 'UserStaffID', 'UserStaffID');
	}

	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

}
