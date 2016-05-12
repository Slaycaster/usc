<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiefOwner extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chief_owners';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ChiefOwnerContent', 'ChiefOwnerDate', 'ChiefMeasureID', 'ChiefID','UserChiefID',];
	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var arrayID
	 */
	protected $primaryKey = 'ChiefOwnerID';

	public function chief()
	{
		return $this->belongsTo('App\Chief', 'ChiefID', 'ChiefID');
	}

	public function user_chief()
	{
		return $this->belongsTo('App\UserChief','UserChiefID','UserChiefID'); //(model, foreign_key, parent_primary_key)
	}

	public function chief_measure()
	{
		return $this->belongsTo('App\ChiefMeasure', 'ChiefMeasureID', 'ChiefMeasureID');
	}

}
