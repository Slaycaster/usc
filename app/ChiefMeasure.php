<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefMeasure extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_measures';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefMeasureName', 'ChiefMeasureType', 'ChiefMeasureFormula', 'ChiefObjectiveID','ChiefID', 'UserChiefID'];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefMeasureID';
	
	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function user_chief()
	{
		return $this->belongsTo('App\UserChief','UserChiefID','UserChiefID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief_objective()
	{
		return $this->belongsTo('App\ChiefObjective','ChiefObjectiveID','ChiefObjectiveID')->orderBy('ChiefObjectiveID', 'asc'); //(model, foreign_key, parent_primary_key)
	}

	public function chief_targets()
	{
		return $this->hasMany('App\ChiefTarget','ChiefMeasureID','ChiefMeasureID'); //(model, foreign_key, parent_primary_key)
	}

	public function staff_measures()
	{
		return $this->hasMany('App\StaffMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}



}
