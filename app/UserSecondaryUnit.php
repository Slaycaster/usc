<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSecondaryUnit extends Model {

	protected $table = 'user_secondary_units';

	/**
	 * The attributes that must be hidden from query. //Slaycaster
	 *
	 * @var array
	 */
	protected $hidden = array('UserSecondaryUnitBadgeNumber', 'UserSecondaryUnitPassword');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserSecondaryUnitBadgeNumber', 'UserSecondaryUnitFirstName', 'UserSecondaryUnitMiddleName', 'UserSecondaryUnitLastName', 'UserSecondaryUnitQualifier', 'UserSecondaryUnitPicturePath', 'UserSecondaryUnitPassword', 'RankID', 'SecondaryUnitID', 'UserSecondaryUnitIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserSecondaryUnitID';

}
