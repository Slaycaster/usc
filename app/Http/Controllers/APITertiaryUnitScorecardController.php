<?php namespace App\Http\Controllers;

//Models
use App\TertiaryUnitTarget;
use App\TertiaryUnitMeasure;
use App\TertiaryUnitObjective;
use App\TertiaryUnit;
use App\UserTertiaryUnit;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnitOwner;
use App\TertiaryUnitInitiative;
use App\TertiaryUnitFunding;
use App\Rank;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect,Response;

class APIUnitScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('tertiary_unit_user_id'))
		{
			$tertiary_unit_id = Session::get('tertiary_unit_user_id', 'default');
			$tertiary_unit_user = UserUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->first();


		$tertiary_unit_id = Session::get('tertiary_unit_user_id', 'default'); //get the UserunitID stored in session.

		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)->select('TertiaryUnitID')->first(); //Get the Unit of the unit

		$currentYear = date("Y");		
		
		$tertiary_unit = Unit::where('TertiaryUnitID', '=', $unit_user->UnitID)->first();
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

	public function LastUpdatedBy()
	{

			$unit_id = Session::get('unit_user_id', 'default'); //get the UserunitID stored in session.

		$unit = UserUnit::where('UserUnitID', '=', $unit_id)->select('UnitID')->first();

			$maxid = UnitAccomplishment::where('UnitID','=',$unit->UnitID)->max('updated_at');
			$maxid2 = UnitOwner::where('UnitID','=',$unit->UnitID)->max('updated_at');
			$maxid3 = UnitInitiative::where('UnitID','=',$unit->UnitID)->max('updated_at');
			$maxid4 = UnitFunding::where('UnitID','=',$unit->UnitID)->max('updated_at');


			$updatedby = UnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_unit')
				->with('user_unit.rank')
				->first();

			$updatedby2 = UnitOwner::where('updated_at','=',$maxid2)
				->with('user_unit')
				->with('user_unit.rank')
				->first(); 

			$updatedby3 = UnitInitiative::where('updated_at','=',$maxid3)
				->with('user_unit')
				->with('user_unit.rank')
				->first();

			$updatedby4 = UnitFunding::where('updated_at','=',$maxid4)
				->with('user_unit')
				->with('user_unit.rank')
				->first(); 

				$lastupdate = array(
					"updated1" => $updatedby,
					"updated2" => $updatedby2,
					"updated3" => $updatedby3,
					"updated4" => $updatedby4
				);
		

			return Response::json($lastupdate);
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
		$unit_id = Session::get('unit_user_id', 'default');
		$unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
			->first();

		$unit_target = UnitTarget::find($id);
		
		$unit_accomplishmentID = $unit_target->UnitAccomplishmentID;
		$unit_ownerID = $unit_target->UnitOwnerID;
		$unit_initiativeID = $unit_target->UnitInitiativeID;
		$unit_fundingID = $unit_target->UnitFundingID;

		

		if(Request::input('Accomplishmentpressed') == true)
		{
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
			$unit_accomplishment->UnitMeasureID = Request::input('UnitMeasureID');
			if($unit_accomplishment->UserUnitID != $unit_id)
			{
				$unit_accomplishment->UserUnitID = $unit_id;	
			}
			//$unit_accomplishment->UserUnitID = $unit_id;
			$unit_accomplishment->UnitID = $unit_user->UnitID;
			$unit_accomplishment->save();
		}
		if(Request::input('Ownerpressed') == true)
		{
			
			$unit_owner = UnitOwner::find($unit_ownerID);
			$unit_owner->UnitOwnerContent = Request::input('UnitOwnerContent');
			$unit_owner->UnitOwnerDate = date('Y-m-d');
			$unit_owner->UnitMeasureID = Request::input('UnitMeasureID');
			if($unit_owner->UserUnitID != $unit_id)
			{
				$unit_owner->UserUnitID = $unit_id;	
			}
			$unit_owner->save();
		}
		if(Request::input('Initiativepressed') == true)
		{

			$unit_initiative = UnitInitiative::find($unit_initiativeID);
			$unit_initiative->UnitInitiativeContent = Request::input('UnitInitiativeContent');
			$unit_initiative->UnitInitiativeDate = date('Y-m-d');
			$unit_initiative->UnitMeasureID = Request::input('UnitMeasureID');
			if($unit_initiative->UserUnitID != $unit_id)
			{
				$unit_initiative->UserUnitID = $unit_id;	
			}
			$unit_initiative->save();
		}

		if(Request::input('Fundingpressed') == true)
		{

			$unit_funding = UnitFunding::find($unit_fundingID);
			$unit_funding->UnitFundingEstimate = Request::input('UnitFundingEstimate');
			$unit_funding->UnitFundingActual = Request::input('UnitFundingActual');
			$unit_funding->UnitFundingDate = date('Y-m-d');
			$unit_funding->UnitMeasureID = Request::input('UnitMeasureID');
			if($unit_funding->UserUnitID != $unit_id)
			{
				$unit_funding->UserUnitID = $unit_id;	
			}
			
			$unit_funding->save();
		}
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
