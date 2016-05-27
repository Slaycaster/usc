<?php namespace App\Http\Controllers;


//Models
use App\UnitMeasure;
use App\UnitTarget;
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

class APIUnitTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$unit_id = Session::get('unit_user_id', 'default');

		$unit = UserUnit::where('UserUnitID', '=', $unit_id)->select('UnitID')->lists('UnitID'); //Get the Unit of the unit

		$currentYear = date("Y");
		
		$unit_targets = UnitTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($unit_targets != null ){
			foreach ($unit_targets as $unit_target) {
				UnitTarget::where('UnitTargetID', $unit_target->UnitTargetID)
		          ->update(['Termination' => 'Terminated']);

				$unittarget = new UnitTarget;
				$unittarget->TargetPeriod = "Not Set";
				$unittarget->UnitMeasureID = $unit_target->UnitMeasureID;
				$unittarget->UnitID = $unit_target->UnitID;
				$unittarget->UserUnitID = $unit_target->UserUnitID;
				$unittarget->save();
			}
		}	
			
		return UnitTarget::with('unit_measure')
			->with('unit_measure.unit_objective')
			->with('user_unit')
			->with('user_unit.rank')
			->where('UnitID', '=', $unit)
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->get();
		
	}

	public function showIndex()
	{
		if (Session::has('unit_user_id'))
		{	
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', '=', $unit_id)
				->with('unit')
				->first();

			$unit = unit::where('UnitID', '=', $user->UnitID)->first();
			$unit_objectives = UnitObjective::all();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $user->UnitID)->get();
			
			return view('unit-ui.unit-targets')
				->with('unit_objectives', $unit_objectives)
				->with('unit', $unit)
				->with('user', $user)
				->with('unit_measures', $unit_measures);
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
		$unit_id = Session::get('unit_user_id', 'default');
		$unit = Request::input('UnitID');
		$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';

		//DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
		
		$unit_target = new UnitTarget(Request::all());
		$unit_target->save();

		$unit_measureid = DB::table('unit_measures')->max('UnitMeasureID');

		//Use Eloquent instead! == Inserting into unit Targets == You forgot target period
		$unit_target = new UnitTarget;
		$unit_target->TargetPeriod = "Not Set";
		$unit_target->UnitMeasureID = $unit_measureid;
		$unit_target->UnitID = $unit;
		$unit_target->UserUnitID = $unit_id;
		$unit_target->save();
		
		return $unit_target;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$unit_target= UnitTarget::find($id);
 		return $unit_target;
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
	public function updateunitarget($id)
	{
		$unit_id = Session::get('unit_user_id', 'default');
		$unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
				->with('unit')
				->first();

		$unit_target = UnitTarget::find($id);
		$unit_target->update(Request::all());

		$unit_target->save();


		/*Saving to Accomplishments etc...*/

		$unit_accomplishment = new UnitAccomplishment();
		$unit_accomplishment->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_accomplishment->UnitID = $unit_user->UnitID;
		$unit_accomplishment->UserUnitID = $unit_user->UserUnitID;
		$unit_accomplishment->save();

		$unit_owner = new UnitOwner();
		$unit_owner->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_owner->UnitID = $unit_user->UnitID;
		$unit_owner->UserUnitID = $unit_user->UserUnitID;
		$unit_owner->save();

		$unit_initiative = new UnitInitiative();
		$unit_initiative->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_initiative->UnitID = $unit_user->UnitID;
		$unit_initiative->UserUnitID = $unit_user->UserUnitID;
		$unit_initiative->save();

		$unit_funding = new UnitFunding();
		$unit_funding->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_funding->UnitID = $unit_user->UnitID;
		$unit_funding->UserUnitID = $unit_user->UserUnitID;
		$unit_funding->save();

 		$unit_target = UnitTarget::find($id);
 		$unit_target->TargetDate = date('Y-m-d');
 		$unit_target->UnitAccomplishmentID = DB::table('unit_accomplishments')->max('UnitAccomplishmentID');
 		$unit_target->UnitOwnerID = DB::table('unit_owners')->max('UnitOwnerID');
 		$unit_target->UnitInitiativeID = DB::table('unit_initiatives')->max('UnitInitiativeID');
 		$unit_target->UnitFundingID = DB::table('unit_fundings')->max('UnitFundingID');
		$unit_target->save();

		return $unit_target;
	}

	public function updateunitquarter($id)
	{
		$unit_id = Session::get('unit_user_id', 'default');
		$unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
				->with('unit')
				->first();
		
		$unit_target = UnitTarget::find($id);
		$targetperiod = Request::input('TargetPeriod');
		$targetdate = date('Y-m-d');
		$quarter1 = Request::input('Quarter1');
		$quarter1 = $quarter1 / 3;
		$unit_target->JanuaryTarget = $quarter1;
		$unit_target->FebruaryTarget = $quarter1;
		$unit_target->MarchTarget = $quarter1;
		
		$quarter2 = Request::input('Quarter2');
		$quarter2 = $quarter2 / 3;
		$unit_target->AprilTarget = $quarter2;
		$unit_target->MayTarget = $quarter2;
		$unit_target->JuneTarget = $quarter2;

		$quarter3 = Request::input('Quarter3');
		$quarter3 = $quarter3 / 3;
		$unit_target->JulyTarget = $quarter3;
		$unit_target->AugustTarget = $quarter3;
		$unit_target->SeptemberTarget = $quarter3;

		$quarter4 = Request::input('Quarter4');
		$quarter4 = $quarter4 / 3;
		$unit_target->OctoberTarget = $quarter4;
		$unit_target->NovemberTarget = $quarter4;
		$unit_target->DecemberTarget = $quarter4;


		$unit_target->TargetPeriod = $targetperiod;
		$unit_target->TargetDate = $targetdate;
		$unit_target->save();

		/*Saving to Accomplishments etc...*/

		$unit_accomplishment = new UnitAccomplishment();
		$unit_accomplishment->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_accomplishment->UnitID = $unit_user->UnitID;
		$unit_accomplishment->UserUnitID = $unit_user->UserUnitID;
		$unit_accomplishment->save();

		$unit_owner = new UnitOwner();
		$unit_owner->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_owner->UnitID = $unit_user->UnitID;
		$unit_owner->UserUnitID = $unit_user->UserUnitID;
		$unit_owner->save();

		$unit_initiative = new UnitInitiative();
		$unit_initiative->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_initiative->UnitID = $unit_user->UnitID;
		$unit_initiative->UserUnitID = $unit_user->UserUnitID;
		$unit_initiative->save();

		$unit_funding = new UnitFunding();
		$unit_funding->UnitMeasureID = $unit_target->UnitMeasureID;
		$unit_funding->UnitID = $unit_user->UnitID;
		$unit_funding->UserUnitID = $unit_user->UserUnitID;
		$unit_funding->save();

 		$unit_target = UnitTarget::find($id);
 		$unit_target->TargetDate = date('Y-m-d');
 		$unit_target->UnitAccomplishmentID = DB::table('unit_accomplishments')->max('UnitAccomplishmentID');
 		$unit_target->UnitOwnerID = DB::table('unit_owners')->max('UnitOwnerID');
 		$unit_target->UnitInitiativeID = DB::table('unit_initiatives')->max('UnitInitiativeID');
 		$unit_target->UnitFundingID = DB::table('unit_fundings')->max('UnitFundingID');
		$unit_target->save();

 	

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
