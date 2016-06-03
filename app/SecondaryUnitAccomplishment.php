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

}
