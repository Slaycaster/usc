<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryUnit extends Model {

	protected $table = 'secondary_units';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['SecondaryUnitName', 'SecondaryUnitAbbreviation', 'PicturePath', 'UnitID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'SecondaryUnitID';

	public function unit()
	{
		return $this->belongsTo('App\Staff', 'UnitID', 'UnitID');
	}

	public function user_secondary_units()
	{
		return $this->hasMany('App\UserSecondaryUnit', 'SecondaryUnitID', 'SecondaryUnitID');
	}
	

}
