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
use App\SecondaryUnitOwner;
use App\SecondaryUnitAccomplishment;
use App\SecondaryUnitFunding;

use App\SecondaryUnitInitiative;

use Request, Session, DB, Validator, Input, Redirect, Response;

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


		$SecondaryUnitTarget =  SecondaryUnitTarget::with('secondary_unit_measure')
			->with('secondary_unit_measure.secondary_unit_objective')
			->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments')
			->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments.tertiary_unit')
			->with('secondary_unit_accomplishment')
			->with('secondary_unit_owner')
			->with('secondary_unit_initiative')
			->with('secondary_unit_funding')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('SecondaryUnitID', '=', $secondary_user->SecondaryUnitID)
			->get();

		return json_encode($SecondaryUnitTarget, JSON_PRETTY_PRINT);
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
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$secondary_user = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_user_id)
				->first();

		$secondary_user_target = SecondaryUnitTarget::find($id);
		$secondary_unit_accomplishmentID = $secondary_user_target->SecondaryUnitAccomplishmentID;
		$secondary_unit_ownerID = $secondary_user_target->SecondaryUnitOwnerID;
		$secondary_unit_initiativeID = $secondary_user_target->SecondaryUnitInitiativeID;
		$secondary_unit_fundingID = $secondary_user_target->SecondaryUnitFundingID;


		if(Request::input('Accomplishmentpressed') == true)
		{
			$secondary_unit_accomplishment = SecondaryUnitAccomplishment::find($secondary_unit_accomplishmentID);
			if (Request::input('JanuaryAccomplishment'))
				$secondary_unit_accomplishment->JanuaryAccomplishment = Request::input('JanuaryAccomplishment');
			else
				$secondary_unit_accomplishment->JanuaryAccomplishment = 0;	

			if(Request::input('FebruaryAccomplishment'))
				$secondary_unit_accomplishment->FebruaryAccomplishment = Request::input('FebruaryAccomplishment');
			else
				$secondary_unit_accomplishment->FebruaryAccomplishment = 0;

			if(Request::input('MarchAccomplishment'))
				$secondary_unit_accomplishment->MarchAccomplishment = Request::input('MarchAccomplishment');
			else
				$secondary_unit_accomplishment->MarchAccomplishment = 0;

			if(Request::input('AprilAccomplishment'))
				$secondary_unit_accomplishment->AprilAccomplishment = Request::input('AprilAccomplishment');
			else
				$secondary_unit_accomplishment->AprilAccomplishment = 0;

			if(Request::input('MayAccomplishment'))
				$secondary_unit_accomplishment->MayAccomplishment = Request::input('MayAccomplishment');
			else
				$secondary_unit_accomplishment->MayAccomplishment = 0;

			if(Request::input('JuneAccomplishment'))
				$secondary_unit_accomplishment->JuneAccomplishment = Request::input('JuneAccomplishment');
			else
				$secondary_unit_accomplishment->JuneAccomplishment = 0;

			if(Request::input('JulyAccomplishment'))
				$secondary_unit_accomplishment->JulyAccomplishment = Request::input('JulyAccomplishment');
			else
				$secondary_unit_accomplishment->JulyAccomplishment = 0;

			if(Request::input('AugustAccomplishment'))
				$secondary_unit_accomplishment->AugustAccomplishment = Request::input('AugustAccomplishment');
			else
				$secondary_unit_accomplishment->AugustAccomplishment = 0;

			if(Request::input('SeptemberAccomplishment'))
				$secondary_unit_accomplishment->SeptemberAccomplishment = Request::input('SeptemberAccomplishment');
			else
				$secondary_unit_accomplishment->SeptemberAccomplishment = 0;
			
			if(Request::input('OctoberAccomplishment'))
				$secondary_unit_accomplishment->OctoberAccomplishment = Request::input('OctoberAccomplishment');
			else
				$secondary_unit_accomplishment->OctoberAccomplishment = 0;

			if(Request::input('NovemberAccomplishment'))
				$secondary_unit_accomplishment->NovemberAccomplishment = Request::input('NovemberAccomplishment');
			else
				$secondary_unit_accomplishment->NovemberAccomplishment = 0;

			if(Request::input('DecemberAccomplishment'))
				$secondary_unit_accomplishment->DecemberAccomplishment = Request::input('DecemberAccomplishment');
			else
				$secondary_unit_accomplishment->DecemberAccomplishment = 0;

			$secondary_unit_accomplishment->AccomplishmentDate = date('Y-m-d');
			$secondary_unit_accomplishment->SecondaryUnitMeasureID = Request::input('SecondaryUnitMeasureID');
			
			$secondary_unit_accomplishment->SecondaryUnitID = $secondary_user->SecondaryUnitID;
			if($secondary_unit_accomplishment->UserSecondaryUnitID != $secondary_user_id)
			{
				$secondary_unit_accomplishment->UserSecondaryUnitID = $secondary_user_id;	
			}
			$secondary_unit_accomplishment->save();
		}
		if(Request::input('Ownerpressed') == true)
		{
			$secondary_unit_owner = SecondaryUnitOwner::find($secondary_unit_ownerID);
			$secondary_unit_owner->SecondaryUnitOwnerContent = Request::input('SecondaryUnitOwnerContent');
			$secondary_unit_owner->SecondaryUnitOwnerDate = date('Y-m-d');
			$secondary_unit_owner->SecondaryUnitMeasureID = Request::input('SecondaryUnitMeasureID');
			if($secondary_unit_owner->UserSecondaryUnitID != $secondary_user_id)
			{
				$secondary_unit_owner->UserSecondaryUnitID = $secondary_user_id;	
			}
			$secondary_unit_owner->save();
		}
		if(Request::input('Initiativepressed') == true)
		{

			$secondary_unit_initiative = SecondaryUnitInitiative::find($secondary_unit_initiativeID);
			$secondary_unit_initiative->SecondaryUnitInitiativeContent = Request::input('SecondaryUnitInitiativeContent');
			$secondary_unit_initiative->SecondaryUnitInitiativeDate = date('Y-m-d');
			$secondary_unit_initiative->SecondaryUnitMeasureID = Request::input('SecondaryUnitMeasureID');
			if($secondary_unit_initiative->UserSecondaryUnitID != $secondary_user_id)
			{
				$secondary_unit_initiative->UserSecondaryUnitID = $secondary_user_id;	
			}
			$secondary_unit_initiative->save();
		}

		if(Request::input('Fundingpressed') == true)
		{

			$secondary_user_funding = SecondaryUnitFunding::find($secondary_unit_fundingID);
			$secondary_user_funding->SecondaryUnitFundingEstimate = Request::input('SecondaryUnitFundingEstimate');
			$secondary_user_funding->SecondaryUnitFundingActual = Request::input('SecondaryUnitFundingActual');
			$secondary_user_funding->SecondaryUnitFundingDate = date('Y-m-d');
			$secondary_user_funding->SecondaryUnitMeasureID = Request::input('SecondaryUnitMeasureID');
			if($secondary_user_funding->UserSecondaryUnitID != $secondary_user_id)
			{
				$secondary_user_funding->UserSecondaryUnitID = $secondary_user_id;	
			}
			$secondary_user_funding->save();
		}
		return $secondary_user_target;
	}

	public function LastUpdatedBy()
	{

			$secondary_user_id = Session::get('secondary_user_id', 'default'); //get the UserstaffID stored in session.

			$secondary_user = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_user_id)->select('SecondaryUnitID')->first();
			

			$maxid = SecondaryUnitAccomplishment::where('SecondaryUnitID','=',$secondary_user->SecondaryUnitID)->max('updated_at');
			$maxid2 = SecondaryUnitOwner::where('SecondaryUnitID','=',$secondary_user->SecondaryUnitID)->max('updated_at');
			$maxid3 = SecondaryUnitInitiative::where('SecondaryUnitID','=',$secondary_user->SecondaryUnitID)->max('updated_at');
			$maxid4 = SecondaryUnitFunding::where('SecondaryUnitID','=',$secondary_user->SecondaryUnitID)->max('updated_at');


			$updatedby = SecondaryUnitAccomplishment::where('updated_at','=',$maxid)
				 ->with('user_secondary_unit')
				 ->with('user_secondary_unit.rank')
				->first();

			$updatedby2 = SecondaryUnitOwner::where('updated_at','=',$maxid2)
				 ->with('user_secondary_unit')
				 ->with('user_secondary_unit.rank')
				->first(); 

			$updatedby3 = SecondaryUnitInitiative::where('updated_at','=',$maxid3)
				 ->with('user_secondary_unit')
				 ->with('user_secondary_unit.rank')
				->first();

			$updatedby4 = SecondaryUnitFunding::where('updated_at','=',$maxid4)
				 ->with('user_secondary_unit')
				 ->with('user_secondary_unit.rank')
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
