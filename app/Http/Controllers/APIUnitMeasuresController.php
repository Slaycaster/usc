<?php namespace App\Http\Controllers;

//Models
use App\UnitObjective;
use App\UnitMeasure;
use App\StaffMeasure;
use App\UserUnit;
use App\Unit;
use App\UnitTarget;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APIUnitMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('unit_user_id', 'default');
		$unit = UserUnit::where('UserUnitID', '=', $id)->select('UnitID')->lists('UnitID'); //Get the Unit of the user
        
		return UnitMeasure::where('UnitID', '=', $unit)
			->with('unit_objective')
			->with('staff_measure')
			->with('unit')
			->with('user_unit')
			->with('user_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('unit_user_id'))
		{
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();

			$unit = Unit::where('UnitID', '=', $user->UnitID)->first();
		
			$staff_measures = StaffMeasure::where('StaffID','=',$unit->StaffID)->get();
			$unit_objectives = UnitObjective::where('UnitID','=',$unit->UnitID)->get();
			$unit_measures = UnitMeasure::where('UnitID', '=', $user->UnitID)->get();
			
			return view('unit-ui.unit-measures')
				->with('user', $user)
				->with('unit', $unit)
				->with('staff_measures', $staff_measures)
				->with('unit_objectives', $unit_objectives)
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

		$id = Session::get('unit_user_id', 'default');
		$unit = Request::input('UnitID');
		$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));

		$unit_measure = new UnitMeasure(Request::all());
		$unit_measure->save();

		//Get the max id after saving.
		$unit_measureid = DB::table('unit_measures')->max('UnitMeasureID');

		//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
		$unit_target = new UnitTarget;
		$unit_target->TargetPeriod = "Not Set";
		$unit_target->UnitMeasureID = $unit_measureid;
		$unit_target->UnitID = $unit;
		$unit_target->UserUnitID = $id;
		$unit_target->save();

		return $unit_measure;

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
		$unit_measure= UnitMeasure::find($id);
 		return $unit_measure;
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


		$unit_measure = UnitMeasure::find($id);
		$unit_measure->update(Request::all());
		$unit_measure->save();
 
		$id = Session::get('unit_user_id', 'default');
		$unit = Request::input('UnitID');
		$action = 'Updated a measure: "' . Request::input('UnitMeasureName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));



		return $unit_measure;



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
