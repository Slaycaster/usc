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
		return $this->hasMany('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

}
