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

}
