<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staffs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['StaffName', 'StaffAbbreviation', 'StaffPermission', 'PicturePath', 'ChiefID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'StaffID';

	public function units()
	{
		return $this->hasMany('App\Unit', 'UnitID', 'UnitID');
	}

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}
}
