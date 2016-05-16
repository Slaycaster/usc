<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffTarget extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_targets';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryTarget', 'FebruaryTarget', 'MarchTarget', 'AprilTarget', 'MayTarget', 'JuneTarget', 
						   'JulyTarget', 'AugustTarget', 'SeptemberTarget', 'OctoberTarget', 'NovemberTarget', 'DecemberTarget',
						   'TargetDate', 'TargetPeriod', 'Termination','StaffMeasureID','StaffAccomplishmentID', 'StaffOwnerID', 'StaffInitiativeID', 'StaffFundingID', 'StaffID','UserStaffID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'StaffTargetID';

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

	public function staff_accomplishment()
	{
		return $this->belongsTo('App\StaffAccomplishment', 'StaffAccomplishmentID', 'StaffAccomplishmentID');
	}

	public function staff_owner()
	{
		return $this->belongsTo('App\StaffOwner', 'StaffOwnerID', 'StaffOwnerID');
	}

	public function staff_initiative()
	{
		return $this->belongsTo('App\StaffInitiative', 'StaffInitiativeID', 'StaffInitiativeID');
	}

	public function staff_funding()
	{
		return $this->belongsTo('App\StaffFunding', 'StaffFundingID', 'StaffFundingID');
	}

}
