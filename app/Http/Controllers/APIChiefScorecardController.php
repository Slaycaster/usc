<?php namespace App\Http\Controllers;

//Models
use App\ChiefTarget;
use App\ChiefMeasure;
use App\ChiefObjective;
use App\Chief;
use App\UserChief;
use App\ChiefAccomplishment;
use App\ChiefOwner;
use App\ChiefInitiative;
use App\ChiefFunding;

use App\StaffAccomplishment;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIChiefScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();


		$chief_id = Session::get('chief_user_id', 'default'); //get the UserChiefID stored in session.

		$chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief

		$currentYear = date("Y");		
		
		$chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
			$chief_objectives = ChiefObjective::all();
			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();

		$staff_accomplishments = StaffAccomplishment::with('staff_measure')->with('staff')->get();

		return ChiefTarget::with('chief_measure')
			->with('chief_measure.staff_measures')
			->with('chief_measure.chief_objective')
			->with('chief_accomplishment')
			->with('chief_owner')
			->with('chief_initiative')
			->with('chief_funding')
			->with('user_chief')
			->with('user_chief.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('ChiefID', '=', $chief_user->ChiefID)
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
		$chief_target = ChiefTarget::find($id);
		$chief_accomplishmentID = $chief_target->ChiefAccomplishmentID;
		$chief_ownerID = $chief_target->ChiefOwnerID;
		$chief_initiativeID = $chief_target->ChiefInitiativeID;
		$chief_fundingID = $chief_target->ChiefFundingID;

		/*

		$chief_accomplishment = ChiefAccomplishment::find($chief_accomplishmentID);
		$chief_accomplishment->JanuaryAccomplishment = Request::input('JanuaryAccomplishment');
		$chief_accomplishment->FebruaryAccomplishment = Request::input('FebruaryAccomplishment');
		$chief_accomplishment->MarchAccomplishment = Request::input('MarchAccomplishment');
		$chief_accomplishment->AprilAccomplishment = Request::input('AprilAccomplishment');
		$chief_accomplishment->MayAccomplishment = Request::input('MayAccomplishment');
		$chief_accomplishment->JuneAccomplishment = Request::input('JuneAccomplishment');
		$chief_accomplishment->JulyAccomplishment = Request::input('JulyAccomplishment');
		$chief_accomplishment->AugustAccomplishment = Request::input('AugustAccomplishment');
		$chief_accomplishment->SeptemberAccomplishment = Request::input('SeptemberAccomplishment');
		$chief_accomplishment->OctoberAccomplishment = Request::input('OctoberAccomplishment');
		$chief_accomplishment->NovemberAccomplishment = Request::input('NovemberAccomplishment');
		$chief_accomplishment->DecemberAccomplishment = Request::input('DecemberAccomplishment');
		$chief_accomplishment->AccomplishmentDate = date('Y-m-d');
		$chief_accomplishment->save();

		*/

		$chief_owner = ChiefOwner::find($chief_ownerID);
		
		// Checks if there's an input or not. [Resolving ErrorException: Creating default object from empty value]~
		if(Request::input('ChiefOwnerContent'))
			$chief_owner->ChiefOwnerContent = Request::input('ChiefOwnerContent');
		else
			$chief_owner->ChiefOwnerContent = '';

		$chief_owner->ChiefOwnerDate = date('Y-m-d');
		$chief_owner->ChiefMeasureID = Request::input('ChiefMeasureID');
		$chief_owner->save();

		$chief_initiative = ChiefInitiative::find($chief_initiativeID);

		// Checks if there's an input or not. [Resolving ErrorException: Creating default object from empty value]~
		if(Request::input('ChiefInitiativeContent'))
			$chief_initiative->ChiefInitiativeContent = Request::input('ChiefInitiativeContent');
		else
			$chief_initiative->ChiefInitiativeContent = '';


		$chief_initiative->ChiefInitiativeDate = date('Y-m-d');
		$chief_initiative->ChiefMeasureID = Request::input('ChiefMeasureID');
		$chief_initiative->save();

		$chief_funding = ChiefFunding::find($chief_fundingID);

		// Checks if there's an input or not. [Resolving ErrorException: Creating default object from empty value]~
		if(Request::input('ChiefFundingEstimate'))
			$chief_funding->ChiefFundingEstimate = Request::input('ChiefFundingEstimate');
		else
			$chief_funding->ChiefFundingEstimate = 0;

		// Checks if there's an input or not. [Resolving ErrorException: Creating default object from empty value]~
		if(Request::input('ChiefFundingActual'))
			$chief_funding->ChiefFundingActual = Request::input('ChiefFundingActual');
		else
			$chief_funding->ChiefFundingActual = 0;

		$chief_funding->ChiefFundingDate = date('Y-m-d');
		$chief_funding->ChiefMeasureID = Request::input('ChiefMeasureID');
		$chief_funding->save();

		return $chief_target;


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
