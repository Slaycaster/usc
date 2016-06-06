<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitAccomplishment extends Model {

	protected $table = 'secondary_unit_accomplishments';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryAccomplishment', 'FebruaryAccomplishment', 'MarchAccomplishment', 'AprilAccomplishment', 'MayAccomplishment', 'JuneAccomplishment', 
						   'JulyAccomplishment', 'AugustAccomplishment', 'SeptemberAccomplishment', 'OctoberAccomplishment', 'NovemberAccomplishment', 'DecemberAccomplishment',
						   'AccomplishmentDate', 'SecondaryUnitMeasureID', 'SecondaryUnitID','UserSecondaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitAccomplishmentID';

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
		return $this->belongsTo('App\UnitSecondaryMeasure', 'UnitSecondaryMeasureID', 'UnitSecondaryMeasureID');
	}

	public function secondary_unit_target()
	{
		return $this->hasOne('App\UnitSecondaryTarget', 'SecondaryUnitAccomplishmentID', 'SecondaryUnitAccomplishmentID'); //(model, foreign_key, parent_primary_key)
	}

}
