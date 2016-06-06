<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitOwner extends Model {

	protected $table = 'secondary_unit_owners';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitOwnerContent', 'SecondaryUnitOwnerDate', 'SecondaryUnitMeasureID', 'SecondaryUnitID','UserSecondaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitOwnerID';

	public function secondary_unit()
	{
		return $this->belongsTo('App\SecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
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
