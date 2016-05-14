<?php namespace App\Http\Controllers;

//Models
use App\UnitTarget;
use App\UnitMeasure;
use App\UnitObjective;
use App\Unit;
use App\UserUnit;
use App\UnitAccomplishment;
use App\UnitOwner;
use App\UnitInitiative;
use App\UnitFunding;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIUnitScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
				->first();


		$unit_id = Session::get('unit_user_id', 'default'); //get the UserunitID stored in session.

		$unit = UserChief::where('UserUnitID', '=', $unit_id)->select('UnitID')->lists('UnitID'); //Get the Unit of the chief

		$currentYear = date("Y");		
		
		$unit = Unit::where('UnitID', '=', $unit_user->UnitID)->first();
			$unit_objectives = UnitObjective::all();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $unit_user->UnitID)->get();
	
		return UnitTarget::with('unit_measure')
			->with('unit_measure.unit_objective')
			->with('unit_measure.unit_owners')
			->with('unit_measure.unit_fundings')
			->with('unit_measure.unit_initiatives')
			->with('unit_measure.unit_accomplishments')
			->with('user_unit')
			->with('user_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('UnitID', '=', $unit_id)
			->get();
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
