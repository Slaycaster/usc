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

		$unit = UserUnit::where('UserUnitID', '=', $unit_id)->select('UnitID')->first(); //Get the Unit of the unit

		$currentYear = date("Y");		
		
		$unit = Unit::where('UnitID', '=', $unit_user->UnitID)->first();
			$unit_objectives = UnitObjective::all();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $unit_user->UnitID)->get();
	
		return UnitTarget::with('unit_measure')
			->with('unit_measure.unit_objective')
			->with('unit_owner')
			->with('unit_funding')
			->with('unit_initiative')
			->with('unit_accomplishment')
			->with('user_unit')
			->with('user_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('UnitID', '=', $unit->UnitID)
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
		$unit_target = UnitTarget::find($id);
		
		$unit_accomplishmentID = $unit_target->UnitAccomplishmentID;
		$unit_ownerID = $unit_target->UnitOwnerID;
		$unit_initiativeID = $unit_target->UnitInitiativeID;
		$unit_fundingID = $unit_target->UnitFundingID;

		$unit_accomplishment = UnitAccomplishment::find($unit_accomplishmentID);
		if (Request::input('JanuaryAccomplishment'))
			$unit_accomplishment->JanuaryAccomplishment = Request::input('JanuaryAccomplishment');
		else
			$unit_accomplishment->JanuaryAccomplishment = 0;	

		if(Request::input('FebruaryAccomplishment'))
			$unit_accomplishment->FebruaryAccomplishment = Request::input('FebruaryAccomplishment');
		else
			$unit_accomplishment->FebruaryAccomplishment = 0;

		if(Request::input('MarchAccomplishment'))
			$unit_accomplishment->MarchAccomplishment = Request::input('MarchAccomplishment');
		else
			$unit_accomplishment->MarchAccomplishment = 0;

		if(Request::input('AprilAccomplishment'))
			$unit_accomplishment->AprilAccomplishment = Request::input('AprilAccomplishment');
		else
			$unit_accomplishment->AprilAccomplishment = 0;

		if(Request::input('MayAccomplishment'))
			$unit_accomplishment->MayAccomplishment = Request::input('MayAccomplishment');
		else
			$unit_accomplishment->MayAccomplishment = 0;

		if(Request::input('JuneAccomplishment'))
			$unit_accomplishment->JuneAccomplishment = Request::input('JuneAccomplishment');
		else
			$unit_accomplishment->JuneAccomplishment = 0;

		if(Request::input('JulyAccomplishment'))
			$unit_accomplishment->JulyAccomplishment = Request::input('JulyAccomplishment');
		else
			$unit_accomplishment->JulyAccomplishment = 0;

		if(Request::input('AugustAccomplishment'))
			$unit_accomplishment->AugustAccomplishment = Request::input('AugustAccomplishment');
		else
			$unit_accomplishment->AugustAccomplishment = 0;

		if(Request::input('SeptemberAccomplishment'))
			$unit_accomplishment->SeptemberAccomplishment = Request::input('SeptemberAccomplishment');
		else
			$unit_accomplishment->SeptemberAccomplishment = 0;
		
		if(Request::input('OctoberAccomplishment'))
			$unit_accomplishment->OctoberAccomplishment = Request::input('OctoberAccomplishment');
		else
			$unit_accomplishment->OctoberAccomplishment = 0;

		if(Request::input('NovemberAccomplishment'))
			$unit_accomplishment->NovemberAccomplishment = Request::input('NovemberAccomplishment');
		else
			$unit_accomplishment->NovemberAccomplishment = 0;

		if(Request::input('DecemberAccomplishment'))
			$unit_accomplishment->DecemberAccomplishment = Request::input('DecemberAccomplishment');
		else
			$unit_accomplishment->DecemberAccomplishment = 0;

		$unit_accomplishment->AccomplishmentDate = date('Y-m-d');
		$unit_accomplishment->save();
		
		
		$unit_owner = UnitOwner::find($unit_ownerID);
		$unit_owner->UnitOwnerContent = Request::input('UnitOwnerContent');
		$unit_owner->UnitOwnerDate = date('Y-m-d');
		$unit_owner->UnitMeasureID = Request::input('UnitMeasureID');
		$unit_owner->save();

		$unit_initiative = UnitInitiative::find($unit_initiativeID);
		$unit_initiative->UnitInitiativeContent = Request::input('UnitInitiativeContent');
		$unit_initiative->UnitInitiativeDate = date('Y-m-d');
		$unit_initiative->UnitMeasureID = Request::input('UnitMeasureID');
		$unit_initiative->save();

		$unit_funding = UnitFunding::find($unit_fundingID);
		$unit_funding->UnitFundingEstimate = Request::input('UnitFundingEstimate');
		$unit_funding->UnitFundingActual = Request::input('UnitFundingActual');
		$unit_funding->UnitFundingDate = date('Y-m-d');
		$unit_funding->UnitMeasureID = Request::input('UnitMeasureID');
		$unit_funding->save();

		return $unit_target;
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
