<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffOwner extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_owners';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffOwnerContent', 'StaffOwnerDate', 'StaffMeasureID', 'StaffID','UserStaffID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'StaffOwnerID';

	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

	public function user_staff()
	{
		return $this->belongsTo('App\UserStaff','UserStaffID','UserStaffID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff_measure()
	{
		return $this->belongsTo('App\StaffMeasure', 'StaffMeasureID', 'StaffMeasureID');
	}
	
	public function staff_target()
	{
		return $this->hasOne('App\StaffTarget', 'StaffOwnerID', 'StaffOwnerID'); //(model, foreign_key, parent_primary_key)
	}

}
