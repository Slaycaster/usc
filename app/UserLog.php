<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_logs';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitUserID', 'LogDateTime', 'LogType', 'IPAddress'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserLogID';


	public function user_unit()
	{
		return $this->belongsTo('App\UserUnit', 'UserUnitID', 'UserUnitID');
	}
}
