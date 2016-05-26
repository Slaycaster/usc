<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefObjective extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefObjectiveName', 'PerspectiveID', 'ChiefID', 'UserChiefID'];

	/**
	 * The attribute that used as primary key.
	 *
	 * @var array
	 */
	protected $primaryKey = 'ChiefObjectiveID';


	public function perspective()
	{
		return $this->belongsTo('App\Perspective', 'PerspectiveID', 'PerspectiveID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function staff_objectives()
	{
		return $this->hasMany('App\StaffObjective','ChiefObjectiveID','ChiefObjectiveID');
	}

	public function user_chief()
	{
		return $this->belongsTo('App\UserChief', 'ChiefObjectiveID', 'ChiefObjectiveID');
	}

	public function chief_measures()
	{
		return $this->hasMany('App\ChiefMeasure','ChiefObjectiveID','ChiefObjectiveID');
	}

}
