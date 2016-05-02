<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefLog extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_logs';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefUserID', 'LogDateTime', 'LogType', 'IPAddress'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefLogID';


	public function UserChief()
	{
		return $this->belongsTo('App\UserChief', 'UserChiefID', 'UserChiefID');
	}

}
