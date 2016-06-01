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
	 * The attributes that must be hidden from query. //Slaycaster
	 *
	 * @var array
	 */
	protected $hidden = array('UserStaffBadgeNumber', 'UserStaffPassword');

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

	public function staff_owners()
	{
		return $this->hasMany('App\StaffOwner', 'StaffOwnerID', 'StaffOwnerID');
	}

	public function staff_initiatives()
	{
		return $this->hasMany('App\StaffInitiative', 'StaffInitiativeID', 'StaffInitiativeID');
	}

	public function staff_fundings()
	{
		return $this->hasMany('App\StaffFunding', 'StaffFundingID', 'StaffFundingID');
	}
	
}
