<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitObjective extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unit_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UnitObjectiveName', 'PerspectiveID', 'UnitID', 'UserUnitID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UnitObjectiveID';

	public function perspective()
	{
		return $this->belongsTo('App\Perspective', 'PerspectiveID', 'PerspectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'UnitID', 'UnitID');
	}

	public function user_unit()
	{
		return $this->belongsTo('App\UserUnit', 'UserUnitID', 'UserUnitID');
	}

}
