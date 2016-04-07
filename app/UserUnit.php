<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUnit extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_units';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserUnitBadgeNumber', 'UserUnitFirstName', 'UserUnitMiddleName', 'UserUnitLastName', 'UserUnitQualifier', 'UserUnitPicturePath', 'UserUnitPassword', 'RankID', 'UnitID', 'UnitUserIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserUnitID';

	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'UnitID', 'UnitID');
	}

	//FOREIGN ITO NG KABILANG TABLE
	public function unit_objectives()
	{
		return $this->hasMany('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

	public function unit_measures()
	{
		return $this->hasMany('App\UnitMeasure', 'UnitMeasureID', 'UnitMeasureID');
	}

	public function user_logs()
	{
		return $this->hasMany('App\UserLog', 'UserUnitID', 'UserUnitID');
	}

	public function audit_trails()
	{
		return $this->hasMany('App\AuditTrail', 'UserUnitID', 'UserUnitID');
	}

}
