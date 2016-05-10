<?php namespace App\Http\Controllers;


//Models
use App\UnitMeasure;
use App\UnitTarget;
use App\UnitObjective;
use App\Unit;
use App\UserUnit;

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

		return UnitTarget::with('unit_measure')
			->with('unit_measure.unit_objective')
			->with('user_unit')
			->with('user_unit.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('UnitID', '=', $unit)
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
		$unit_target = UnitTarget::find($id);
		$unit_target->update(Request::all());

		$unit_target->save();
 	

		return $unit_target;
	}

	public function updateunitquarter($id)
	{

		$unit_target = UnitTarget::find($id);
		$targetperiod = Request::input('TargetPeriod');
		$targetdate = Request::input('TargetDate');

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
