<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ranks';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['RankName, RankCode, Hierarchy'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'RankID';

	public function user_units()
	{
		return $this->hasMany('App\UserUnit', 'UserUnitID', 'UserUnitID'); //(model, foreign key, parent key)
	}

}
