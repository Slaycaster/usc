<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chief extends Model {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chiefs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefName', 'ChiefAbbreviation',  'PicturePath'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefID';

	public function staffs()
	{
		return $this->hasMany('App\Staff', 'StaffID', 'StaffID');
	}

	public function userchiefs()
	{
		return $this->hasMany('App\UserChief', 'ChiefID', 'ChiefID');
	}
	public function chief_objectives()
	{
		return $this->hasMany('App\ChiefObjective', 'ChiefObjectiveID','ChiefObjectiveID');
	}

}
