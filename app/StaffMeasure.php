<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffMeasureName', 'StaffMeasureType', 'StaffMeasureFormula','StaffObjectiveID','ChiefMeasureID','StaffID', 'UserStaffID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffMeasureID';

	public function chief_measure()
	{
		return $this->belongsTo('App\ChiefMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}

	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

	public function user_staff()
	{
		return $this->belongsTo('App\UserStaff','UserStaffID','UserStaffID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff_objective()
	{
		return $this->belongsTo('App\StaffObjective','StaffObjectiveID','StaffObjectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function unit_measures()
	{
		return $this->hasMany('App\UnitMeasure','StaffMeasureID','StaffMeasureID');
	}

	public function staff_targets()
	{
		return $this->hasMany('App\StaffTarget', 'StaffMeasureID', 'StaffMeasureID');
	}

	public function staff_accomplishments()
	{
		return $this->hasMany('App\StaffAccomplishment', 'StaffMeasureID', 'StaffMeasureID');
	}

	public function staff_owners()
	{
		return $this->hasMany('App\StaffOwner', 'StaffMeasureID', 'StaffMeasureID');
	}

	public function staff_initiatives()
	{
		return $this->hasMany('App\StaffInitiative', 'StaffMeasureID', 'StaffMeasureID');
	}

	public function staff_fundings()
	{
		return $this->hasMany('App\StaffFunding', 'StaffMeasureID', 'StaffMeasureID');
	}
}
