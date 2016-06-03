<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnitFunding extends Model {

	protected $table = 'secondary_unit_fundings';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitFundingEstimate', 'SecondaryUnitFundingActual', 'SecondaryUnitFundingDate', 'SecondaryUnitMeasureID', 'SecondaryUnitID','UserSecondaryUnitID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'SecondaryUnitFundingID';

}
