<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TertiaryUnitAccomplishment extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiary_unit_accomplishments';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['JanuaryAccomplishment', 'FebruaryAccomplishment', 'MarchAccomplishment', 'AprilAccomplishment', 'MayAccomplishment', 'JuneAccomplishment', 
						   'JulyAccomplishment', 'AugustAccomplishment', 'SeptemberAccomplishment', 'OctoberAccomplishment', 'NovemberAccomplishment', 'DecemberAccomplishment',
						   'AccomplishmentDate', 'TertiaryUnitMeasureID', 'TertiaryUnitID','UserTertiaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'TertiaryUnitAccomplishmentID';

	public function tertiary_unit()
	{
		return $this->belongsTo('App\TertiaryUnit', 'TertiaryUnitID', 'TertiaryUnitID');
	}

	public function user_tertiary_unit()
	{
		return $this->belongsTo('App\UserTertiaryUnit','UserTertiaryUnitID','UserTertiaryUnitID'); //(model, foreign_key, parent_primary_key)
	}

	public function tertiary_unit_measure()
	{
		return $this->belongsTo('App\TertiaryUnitMeasure', 'TertiaryUnitMeasureID', 'TertiaryUnitMeasureID');
	}

	public function tertiary_unit_target()
	{
		return $this->hasOne('App\TertiaryUnitTarget', 'TertiaryUnitAccomplishmentID', 'TertiaryUnitAccomplishmentID'); //(model, foreign_key, parent_primary_key)
	}
}
