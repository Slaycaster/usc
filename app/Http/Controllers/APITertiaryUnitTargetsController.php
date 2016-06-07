<?php namespace App\Http\Controllers;


//Models
use App\TertiaryUnitMeasure;
use App\TertiaryUnitTarget;
use App\TertiaryUnitObjective;
use App\TertiaryUnit;
use App\UserTertiaryUnit;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnitOwner;
use App\TertiaryUnitInitiative;
use App\TertiaryUnitFunding;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APITertiaryUnitTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');

		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)->select('TertiaryUnitID')->lists('TertiaryUnitID'); //Get the Unit of the unit

		$currentYear = date("Y");
		
		$tertiary_unit_targets = TertiaryUnitTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($tertiary_unit_targets != null ){
			foreach ($tertiary_unit_targets as $tertiary_unit_target) {
				TertiaryUnitTarget::where('TertiaryUnitTargetID', $tertiary_unit_target->TertiaryUnitTargetID)
		          ->update(['Termination' => 'Terminated']);

				$tertiaryunittarget = new TertiaryUnitTarget;
				$tertiaryunittarget->TargetPeriod = "Not Set";
				$tertiaryunittarget->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
				$tertiaryunittarget->TertiaryUnitID = $tertiary_unit_target->TertiaryUnitID;
				$tertiaryunittarget->UserTertiaryUnitID = $tertiary_unit_target->UserTertiaryUnitID;
				$tertiaryunittarget->save();
			}
		}	
			
		return TertiaryUnitTarget::with('tertiary_unit_measure')
			->with('tertiary_unit_measure.tertiary_unit_objective')
			->with('user_tertiary_unit')
			->with('user_tertiary_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->where('TertiaryUnitID', '=', $tertiary_unit)
			->get();
		
	}

	public function showIndex()
	{
		if (Session::has('tertiary_user_id'))
		{	
			$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->with('tertiary_unit')
				->first();

			$tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->first();
			$tertiary_unit_objectives = TertiaryUnitObjective::all();
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();
			
			return view('tertiary-ui.tertiary-targets')
				->with('tertiary_unit_objectives', $tertiary_unit_objectives)
				->with('tertiary_unit', $tertiary_unit)
				->with('user', $user)
				->with('tertiary_unit_measures', $tertiary_unit_measures);
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
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = Request::input('TertiaryUnitID');
		$action = 'Added a measure: "' . Request::input('TertiaryUnitMeasureName') . '"';

		//DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
		
		$tertiary_unit_target = new TertiaryUnitTarget(Request::all());
		$tertiary_unit_target->save();

		$tertiary_unit_measureid = DB::table('tertiary_unit_measures')->max('TertiaryUnitMeasureID');

		//Use Eloquent instead! == Inserting into unit Targets == You forgot target period
		$tertiary_unit_target = new TertiaryUnitTarget;
		$tertiary_unit_target->TargetPeriod = "Not Set";
		$tertiary_unit_target->TertiaryUnitMeasureID = $tertiary_unit_measureid;
		$tertiary_unit_target->TertiaryUnitID = $tertiary_unit;
		$tertiary_unit_target->UserTertiaryUnitID = $tertiary_unit_id;
		$tertiary_unit_target->save();
		
		return $tertiary_unit_target;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tertiary_unit_target= TertiaryUnitTarget::find($id);
 		return $tertiary_unit_target;
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
	public function updatetertiaryunitarget($id)
	{
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit_user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->with('tertiary_unit')
				->first();

		$tertiary_unit_target = TertiaryUnitTarget::find($id);
		$tertiary_unit_target->update(Request::all());

		$tertiary_unit_target->save();


		/*Saving to Accomplishments etc...*/

		$tertiary_unit_accomplishment = new TertiaryUnitAccomplishment();
		$tertiary_unit_accomplishment->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_accomplishment->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_accomplishment->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_accomplishment->save();

		$tertiary_unit_owner = new TertiaryUnitOwner();
		$tertiary_unit_owner->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_owner->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_owner->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_owner->save();

		$tertiary_unit_initiative = new TertiaryUnitInitiative();
		$tertiary_unit_initiative->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_initiative->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_initiative->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_initiative->save();

		$tertiary_unit_funding = new TertiaryUnitFunding();
		$tertiary_unit_funding->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_funding->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_funding->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_funding->save();

 		$tertiary_unit_target = TertiaryUnitTarget::find($id);
 		$tertiary_unit_target->TargetDate = date('Y-m-d');
 		$tertiary_unit_target->TertiaryUnitAccomplishmentID = DB::table('tertiary_unit_accomplishments')->max('TertiaryUnitAccomplishmentID');
 		$tertiary_unit_target->TertiaryUnitOwnerID = DB::table('tertiary_unit_owners')->max('TertiaryUnitOwnerID');
 		$tertiary_unit_target->TertiaryUnitInitiativeID = DB::table('tertiary_unit_initiatives')->max('TertiaryUnitInitiativeID');
 		$tertiary_unit_target->TertiaryUnitFundingID = DB::table('tertiary_unit_fundings')->max('TertiaryUnitFundingID');
		$tertiary_unit_target->save();

		return $tertiary_unit_target;
	}

	public function updatetertiaryunitquarter($id)
	{
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit_user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->with('tertiary_unit')
				->first();
		
		$tertiary_unit_target = TertiaryUnitTarget::find($id);
		$targetperiod = Request::input('TargetPeriod');
		$targetdate = date('Y-m-d');
		$quarter1 = Request::input('Quarter1');
		$quarter1 = $quarter1 / 3;
		$tertiary_unit_target->JanuaryTarget = $quarter1;
		$tertiary_unit_target->FebruaryTarget = $quarter1;
		$tertiary_unit_target->MarchTarget = $quarter1;
		
		$quarter2 = Request::input('Quarter2');
		$quarter2 = $quarter2 / 3;
		$tertiary_unit_target->AprilTarget = $quarter2;
		$tertiary_unit_target->MayTarget = $quarter2;
		$tertiary_unit_target->JuneTarget = $quarter2;

		$quarter3 = Request::input('Quarter3');
		$quarter3 = $quarter3 / 3;
		$tertiary_unit_target->JulyTarget = $quarter3;
		$tertiary_unit_target->AugustTarget = $quarter3;
		$tertiary_unit_target->SeptemberTarget = $quarter3;

		$quarter4 = Request::input('Quarter4');
		$quarter4 = $quarter4 / 3;
		$tertiary_unit_target->OctoberTarget = $quarter4;
		$tertiary_unit_target->NovemberTarget = $quarter4;
		$tertiary_unit_target->DecemberTarget = $quarter4;


		$tertiary_unit_target->TargetPeriod = $targetperiod;
		$tertiary_unit_target->TargetDate = $targetdate;
		$tertiary_unit_target->save();

		/*Saving to Accomplishments etc...*/

		$tertiary_unit_accomplishment = new TertiaryUnitAccomplishment();
		$tertiary_unit_accomplishment->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_accomplishment->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_accomplishment->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_accomplishment->save();

		$tertiary_unit_owner = new TertiaryUnitOwner();
		$tertiary_unit_owner->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_owner->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_owner->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_owner->save();

		$tertiary_unit_initiative = new TertiaryUnitInitiative();
		$tertiary_unit_initiative->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_initiative->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_initiative->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_initiative->save();

		$tertiary_unit_funding = new TertiaryUnitFunding();
		$tertiary_unit_funding->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
		$tertiary_unit_funding->TertiaryUnitID = $tertiary_unit_user->TertiaryUnitID;
		$tertiary_unit_funding->UserTertiaryUnitID = $tertiary_unit_user->UserTertiaryUnitID;
		$tertiary_unit_funding->save();

 		$tertiary_unit_target = TertiaryUnitTarget::find($id);
 		$tertiary_unit_target->TargetDate = date('Y-m-d');
 		$tertiary_unit_target->TertiaryUnitAccomplishmentID = DB::table('tertiary_unit_accomplishments')->max('TertiaryUnitAccomplishmentID');
 		$tertiary_unit_target->TertiaryUnitOwnerID = DB::table('tertiary_unit_owners')->max('TertiaryUnitOwnerID');
 		$tertiary_unit_target->TertiaryUnitInitiativeID = DB::table('tertiary_unit_initiatives')->max('TertiaryUnitInitiativeID');
 		$tertiary_unit_target->TertiaryUnitFundingID = DB::table('tertiary_unit_fundings')->max('TertiaryUnitFundingID');
		$tertiary_unit_target->save();

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
