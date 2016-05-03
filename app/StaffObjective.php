<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffObjective extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffObjectiveName', 'PerspectiveID', 'StaffID', 'ChiefObjectiveID', 'UserStaffID'];

	/**
	 * The attribute that used as primary key.
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffObjectiveID';


	public function perspective()
	{
		return $this->belongsTo('App\Perspective', 'PerspectiveID', 'PerspectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff()
	{
		return $this->belongsTo('App\Staff', 'StaffID', 'StaffID');
	}

	public function chief_objective()
	{
		return $this->belongsTo('App\ChiefObjective', 'ChiefObjectiveID','ChiefObjectiveID');
	}

	public function unit_objectives()
	{ 
		return $this->hasMany('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

	public function user_staff()
	{
		return $this->belongsTo('App\UserStaff', 'UserStaffID', 'UserStaffID');
	}

	public function staff_measure()
	{ 
		return $this->hasMany('App\StaffMeasure', 'StaffMeasureID', 'StaffMeasureID');
	}
}
