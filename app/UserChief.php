<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChief extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_chiefs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['UserChiefBadgeNumber', 'UserChiefFirstName', 'UserChiefMiddleName', 'UserChiefLastName', 'UserChiefQualifier', 'UserChiefPicturePath', 'UserChiefPassword', 'RankID', 'StaffID', 'UserChiefIsActive'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'UserChiefID';


	//FOREIGN KEYS
	public function rank()
	{
		return $this->belongsTo('App\Rank', 'RankID', 'RankID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

}
