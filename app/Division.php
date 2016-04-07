<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'divisions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['DivisionName', 'DivisionAbbreviation', 'DivisionPicturePath', 'UnitID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'DivisionID';

	public function unit()
	{
		return $this->belongsTo('App\Unit', 'UnitID', 'UnitID'); //(model, foreign_key, parent_primary_key)
	}

}
