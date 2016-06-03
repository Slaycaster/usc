<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitObjective extends Model {

	protected $table = 'secondary_unit_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitObjectiveName', 'PerspectiveID', 'SecondaryUnitID', 'UserSecondaryUnitID', 'UnitObjectiveID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitObjectiveID';

	public function perspective()
	{
		return $this->belongsTo('App\Perspective', 'PerspectiveID', 'PerspectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function user_secondary_unit()
	{
		return $this->belongsTo('App\UserSecondaryUnit', 'UserSecondaryUnitID', 'UserSecondaryUnitID');
	}

	public function unitobjective()
	{
		return $this->belongsTo('App\UnitObjective', 'UnitObjectiveID', 'UnitObjectiveID');
	}

	public function secondary_unit_measures()
	{
		return $this->hasMany('App\SecondaryUnitMeasure','SecondaryUnitMeasureID','SecondaryUnitMeasureID');
	}

}
