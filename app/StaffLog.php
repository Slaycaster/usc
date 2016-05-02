<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffLog extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_logs';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffUserID', 'LogDateTime', 'LogType', 'IPAddress'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffLogID';


	public function UserStaff()
	{
		return $this->belongsTo('App\UserStaff', 'UserStaffID', 'UserStaffID');
	}

}