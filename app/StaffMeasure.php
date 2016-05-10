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

	public function chief_measures()
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

	public function unit_measure()
	{
		return $this->hasMany('App\UnitMeasure','UnitMeasureID','UnitMeasureID');
	}

	public function staff_targets()
	{
		return $this->hasMany('App\StaffTarget', 'StaffTargetID', 'StaffTargetID');
	}

}
