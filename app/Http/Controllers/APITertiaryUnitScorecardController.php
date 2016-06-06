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

class APITertiaryUnitScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('tertiary_user_id'))
		{
			$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
			$tertiary_unit_user = UserUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->first();


		$tertiary_unit_id = Session::get('tertiary_user_id', 'default'); //get the UserunitID stored in session.

		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)->select('TertiaryUnitID')->first(); //Get the Unit of the unit

		$currentYear = date("Y");		
		
		$tertiary_unit = Unit::where('TertiaryUnitID', '=', $tertiary_unit_user->TertiaryUnitID)->first();
			$tertiary_unit_objectives = TertiaryUnitObjective::all();
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $tertiary_unit_user->TertiaryUnitID)->get();
	
		return TertiaryUnitTarget::with('tertiary_unit_measure')
			->with('tertiary_unit_measure.tertiary_unit_objective')
			->with('tertiary_unit_owner')
			->with('tertiary_unit_funding')
			->with('tertiary_unit_initiative')
			->with('tertiary_unit_accomplishment')
			->with('user_tertiary_unit')
			->with('user_tertiary_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('TertiaryUnitID', '=', $tertiary_unit->TertiaryUnitID)
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

			$tertiary_unit_id = Session::get('tertiary_user_id', 'default'); //get the UserunitID stored in session.

			$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)->select('TertiaryUnitID')->first();

			$maxid = TertiaryUnitAccomplishment::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)->max('updated_at');
			$maxid2 = TertiaryUnitOwner::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)->max('updated_at');
			$maxid3 = TertiaryUnitInitiative::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)->max('updated_at');
			$maxid4 = TertiaryUnitFunding::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)->max('updated_at');


			$updatedby = TertiaryUnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_tertiary_unit')
				->with('user_tertiary_unit.rank')
				->first();

			$updatedby2 = TertiaryUnitOwner::where('updated_at','=',$maxid2)
				->with('user_tertiary_unit')
				->with('user_tertiary_unit.rank')
				->first(); 

			$updatedby3 = TertiaryUnitInitiative::where('updated_at','=',$maxid3)
				->with('user_tertiary_unit')
				->with('user_tertiary_unit.rank')
				->first();

			$updatedby4 = TertiaryUnitFunding::where('updated_at','=',$maxid4)
				->with('user_tertiary_unit')
				->with('user_tertiary_unit.rank')
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
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit_user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
			->first();

		$tertiary_unit_target = TertiaryUnitTarget::find($id);
		
		$tertiary_unit_accomplishmentID = $tertiary_unit_target->TertiaryUnitAccomplishmentID;
		$tertiary_unit_ownerID = $tertiary_unit_target->Tertiary_UnitOwnerID;
		$tertiary_unit_initiativeID = $tertiary_unit_target->TertiaryUnitInitiativeID;
		$tertiary_unit_fundingID = $tertiary_unit_target->TertiaryUnitFundingID;

		

		if(Request::input('Accomplishmentpressed') == true)
		{
			$tertiary_unit_accomplishment = TertiaryUnitAccomplishment::find($tertiary_unit_accomplishmentID);
			if (Request::input('JanuaryAccomplishment'))
				$tertiary_unit_accomplishment->JanuaryAccomplishment = Request::input('JanuaryAccomplishment');
			else
				$tertiary_unit_accomplishment->JanuaryAccomplishment = 0;	

			if(Request::input('FebruaryAccomplishment'))
				$tertiary_unit_accomplishment->FebruaryAccomplishment = Request::input('FebruaryAccomplishment');
			else
				$tertiary_unit_accomplishment->FebruaryAccomplishment = 0;

			if(Request::input('MarchAccomplishment'))
				$tertiary_unit_accomplishment->MarchAccomplishment = Request::input('MarchAccomplishment');
			else
				$tertiary_unit_accomplishment->MarchAccomplishment = 0;

			if(Request::input('AprilAccomplishment'))
				$tertiary_unit_accomplishment->AprilAccomplishment = Request::input('AprilAccomplishment');
			else
				$tertiary_unit_accomplishment->AprilAccomplishment = 0;

			if(Request::input('MayAccomplishment'))
				$tertiary_unit_accomplishment->MayAccomplishment = Request::input('MayAccomplishment');
			else
				$tertiary_unit_accomplishment->MayAccomplishment = 0;

			if(Request::input('JuneAccomplishment'))
				$tertiary_unit_accomplishment->JuneAccomplishment = Request::input('JuneAccomplishment');
			else
				$tertiary_unit_accomplishment->JuneAccomplishment = 0;

			if(Request::input('JulyAccomplishment'))
				$tertiary_unit_accomplishment->JulyAccomplishment = Request::input('JulyAccomplishment');
			else
				$tertiary_unit_accomplishment->JulyAccomplishment = 0;

			if(Request::input('AugustAccomplishment'))
				$tertiary_unit_accomplishment->AugustAccomplishment = Request::input('AugustAccomplishment');
			else
				$tertiary_unit_accomplishment->AugustAccomplishment = 0;

			if(Request::input('SeptemberAccomplishment'))
				$tertiary_unit_accomplishment->SeptemberAccomplishment = Request::input('SeptemberAccomplishment');
			else
				$tertiary_unit_accomplishment->SeptemberAccomplishment = 0;
			
			if(Request::input('OctoberAccomplishment'))
				$tertiary_unit_accomplishment->OctoberAccomplishment = Request::input('OctoberAccomplishment');
			else
				$tertiary_unit_accomplishment->OctoberAccomplishment = 0;

			if(Request::input('NovemberAccomplishment'))
				$tertiary_unit_accomplishment->NovemberAccomplishment = Request::input('NovemberAccomplishment');
			else
				$tertiary_unit_accomplishment->NovemberAccomplishment = 0;

			if(Request::input('DecemberAccomplishment'))
				$tertiary_unit_accomplishment->DecemberAccomplishment = Request::input('DecemberAccomplishment');
			else
				$tertiary_unit_accomplishment->DecemberAccomplishment = 0;

			$tertiary_unit_accomplishment->AccomplishmentDate = date('Y-m-d');
			$tertiary_unit_accomplishment->TertiaryUnitMeasureID = Request::input('TertiaryUnitMeasureID');
			if($tertiary_unit_accomplishment->UserTertiaryUnitID != $tertiary_unit_id)
			{
				$tertiary_unit_accomplishment->UserTertiaryUnitID = $tertiary_unit_id;	
			}
			//$unit_accomplishment->UserUnitID = $unit_id;
			$tertiary_unit_accomplishment->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
			$tertiary_unit_accomplishment->save();
		}
		if(Request::input('Ownerpressed') == true)
		{
			
			$tertiary_unit_owner = TertiaryUnitOwner::find($tertiary_unit_ownerID);
			$tertiary_unit_owner->TertiaryUnitOwnerContent = Request::input('TertiaryUnitOwnerContent');
			$tertiary_unit_owner->TertiaryUnitOwnerDate = date('Y-m-d');
			$tertiary_unit_owner->TertiaryUnitMeasureID = Request::input('TertiaryUnitMeasureID');
			if($tertiary_unit_owner->UserTertiaryUnitID != $tertiary_unit_id)
			{
				$tertiary_unit_owner->UserTertiaryUnitID = $tertiary_unit_id;	
			}
			$tertiary_unit_owner->save();
		}
		if(Request::input('Initiativepressed') == true)
		{

			$tertiary_unit_initiative = TertiaryUnitInitiative::find($tertiary_unit_initiativeID);
			$tertiary_unit_initiative->TertiaryUnitInitiativeContent = Request::input('TertiaryUnitInitiativeContent');
			$tertiary_unit_initiative->TertiaryUnitInitiativeDate = date('Y-m-d');
			$tertiary_unit_initiative->TertiaryUnitMeasureID = Request::input('TertiaryUnitMeasureID');
			if($tertiary_unit_initiative->UserTertiaryUnitID != $tertiary_unit_id)
			{
				$tertiary_unit_initiative->UserTertiaryUnitID = $tertiary_unit_id;	
			}
			$tertiary_unit_initiative->save();
		}

		if(Request::input('Fundingpressed') == true)
		{

			$tertiary_unit_funding = TertiaryUnitFunding::find($tertiary_unit_fundingID);
			$tertiary_unit_funding->TertiaryUnitFundingEstimate = Request::input('TertiaryUnitFundingEstimate');
			$tertiary_unit_funding->TertiaryUnitFundingActual = Request::input('TertiaryUnitFundingActual');
			$tertiary_unit_funding->TertiaryUnitFundingDate = date('Y-m-d');
			$tertiary_unit_funding->TertiaryUnitMeasureID = Request::input('TertiaryUnitMeasureID');
			if($tertiary_unit_funding->UserTertiaryUnitID != $tertiary_unit_id)
			{
				$tertiary_unit_funding->UserTertiaryUnitID = $tertiary_unit_id;	
			}
			
			$tertiary_unit_funding->save();
		}
		return $tertiary_unit_target;
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
