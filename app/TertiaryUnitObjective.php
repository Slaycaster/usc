<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnitObjective extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_unit_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TertiaryUnitObjectiveName', 'PerspectiveID', 'TertiaryUnitID', 'UserTertiaryUnitID', 'SecondaryUnitObjectiveID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryUnitObjectiveID';

	public function perspective()
	{
		return $this->belongsTo('App\Perspective', 'PerspectiveID', 'PerspectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function user_tertiary_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit', 'UserTertiaryUnitID', 'UserTertiaryUnitID');
	}

	public function secondary_unit_objective()
	{
		return $this->belongsTo('App\SecondaryUnitObjective', 'SecondaryUnitObjectiveID', 'SecondaryUnitObjectiveID');
	}

	public function tertiary_unit_measures()
	{
		return $this->hasMany('App\TertiaryUnitMeasure','TertiaryUnitMeasureID','TertiaryUnitMeasureID');
	}
}
