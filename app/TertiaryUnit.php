<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tertiary extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tertiaries';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['TertiaryName', 'TertiaryAbbreviation', 'PicturePath', 'SecondaryID'];

	/**
	 * The attribute that used as primary key. //Slaycaster
	 *
	 * @var array
	 */
	protected $primaryKey = 'TertiaryID';


	public function secondary()
	{
		return $this->belongsTo('App\Secondary', 'SecondaryID', 'SecondaryID');
	}

	public function user_tertiaries()
	{
		return $this->hasMany('App\UserTertiary', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_objectives()
	{
		return $this->hasMany('App\TertiaryObjective', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_measures()
	{
		return $this->hasMany('App\TertiaryMeasure', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_audit_trails()
	{
		return $this->hasMany('App\AuditTrails', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_targets()
	{
		return $this->hasMany('App\TertiaryTarget', 'TertiaryID', 'TertiaryID');
	}
	
	public function tertiary_accomplishments()
	{
		return $this->hasMany('App\TertiaryAccomplishment', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_owners()
	{
		return $this->hasMany('App\TertiaryOwner', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_initiatives()
	{
		return $this->hasMany('App\TertiaryInitiative', 'TertiaryID', 'TertiaryID');
	}

	public function tertiary_fundings()
	{
		return $this->hasMany('App\TertiaryFunding', 'TertiaryID', 'TertiaryID');
	}

}
