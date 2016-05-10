<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStaff extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_staffs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserStaffBadgeNumber', 'UserStaffFirstName', 'UserStaffMiddleName', 'UserStaffLastName', 'UserStaffQualifier', 'UserStaffPicturePath', 'UserStaffPassword', 'RankID', 'StaffID', 'UserStaffIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserStaffID';


	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

	public function staff_objectives()
	{
		return $this->hasMany('App\StaffObjective', 'StaffObjectiveID', 'StaffObjectiveID');
	}

	public function staff_targets()
	{
		return $this->hasMany('App\StaffTarget', 'StaffTargetID', 'StaffTargetID');
	}

	public function staff_accomplishments()
	{
		return $this->hasMany('App\StaffAccomplishment', 'StaffAccomplishmentID', 'StaffAccomplishmentID');
	}
	
}
