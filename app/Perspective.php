<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Perspective extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'perspectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['PerspectiveName'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'PerspectiveID';

	public function unit_objectives()
	{
		return $this->hasMany('App\UnitObjective', 'PerspectiveID', 'PerspectiveID');
	}

	public function chief_objectives()
	{
		return $this->hasMany('App\ChiefObjective', 'PerspectiveID', 'PerspectiveID');
	}

	public function staff_objectives()
	{
		return $this->hasMany('App\StaffObjective', 'PerspectiveID', 'PerspectiveID');
	}

}
