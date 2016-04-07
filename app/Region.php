<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'regions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['RegionName', 'RegionAbbreviation'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'RegionID';

	public function units()
	{
		return $this->hasMany('App\Unit', 'RegionID', 'RegionID');
	}
}
