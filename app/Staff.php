<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staffs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffName', 'StaffAbbreviation', 'StaffPermission', 'PicturePath', 'ChiefID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffID';

	public function units()
	{
		return $this->hasMany('App\Unit', 'UnitID', 'UnitID');
	}

	public function userstaffs()
	{
		return $this->hasMany('App\UserStaff', 'UserStaffID', 'UserStaffID');
	}


	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function staff_objectives()
	{
		return $this->hasMany('App\StaffObjective','StaffObjectiveID','StaffObjectiveID');
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
