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

}
