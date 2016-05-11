<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffFunding extends Model {

		//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_fundings';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffFundingEstimate', 'StaffFundingActual', 'StaffFundingDate', 'StaffMeasureID', 'StaffID','UserStaffID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'StaffFundingID';

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

}
