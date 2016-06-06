<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitInitiative extends Model {

	protected $table = 'secondary_unit_initiatives';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitInitiativeContent', 'SecondaryUnitInitiativeDate', 'SecondaryUnitMeasureID', 'SecondaryUnitID','UserSecondaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitInitiativeID';


	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondartUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}

	public function user_secondary_unit()
	{
		return $this->belongsTo('App\UserSecondaryUnit','UserSecondaryUnitID','UserSecondaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function secondary_unit_measure()
	{
		return $this->belongsTo('App\SecondaryUnitMeasure', 'SecondaryUnitMeasureID', 'SecondaryUnitMeasureID');
	}

	public function secondary_unit_target()
	{
		return $this->hasOne('App\SecondaryUnitTarget', 'SecondaryUnitTargetID', 'SecondaryUnitTargetID'); //(model, foreign_key, parent_primary_key)
	}

}
