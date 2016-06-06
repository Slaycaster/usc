<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserSecondaryUnit;
use App\SecondaryUnit;
use App\SecondaryUnitObjective;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitTarget;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnit;

use Request, Session, DB, Validator, Input, Redirect;

class APISecondaryUnitScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_id = Session::get('secondary_user_id', 'default');
			$secondary_user = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_id)
				->first();


		$secondary_id = Session::get('secondary_user_id', 'default'); //get the UserChiefID stored in session.

		$secondary_user = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_id)->select('SecondaryUnitID')->lists('SecondaryUnitID'); //Get the Unit of the chief

		$currentYear = date("Y");		
		
		$secondary_user = SecondaryUnit::where('SecondaryUnitID', '=', $secondary_user)->first();
			$secondary_objectives = SecondaryUnitObjective::all();
			$secondary_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $secondary_user->SecondaryUnitID)->get();


		return SecondaryUnitTarget::with('secondary_unit_measure')
			->with('secondary_unit_measure.secondary_unit_objective')
			->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments')
			->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments.tertiary')
			->with('secondary_unit_accomplishment')
			->with('secondary_unit_owner')
			->with('secondary_unit_initiative')
			->with('secondary_unit_funding')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('SecondaryUnitID', '=', $secondary_user->SecondaryUnitID)
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
