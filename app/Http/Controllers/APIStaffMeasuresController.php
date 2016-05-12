<?php namespace App\Http\Controllers;

//Laravel Models
use App\StaffMeasure;
use App\StaffObjective;
use App\ChiefMeasure;
use App\StaffTarget;
use App\Staff;
use App\UserStaff;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIStaffMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->lists('StaffID'); //Get the Unit of the staff
		return StaffMeasure::where('StaffID', '=', $staff)
			->with('staff_objective')
			->with('staff')
			->with('chief_measures')
			->with('user_staff')
			->with('user_staff.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();

			$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$chief_measures = ChiefMeasure::all();
			$staff_objectives = StaffObjective::where('StaffID','=', $staff->StaffID)->get();

			$staff_measures = StaffMeasure::with('staff')->with('chief_measures')->where('StaffID', '=', $staff_user->StaffID)->get();
			
			return view('staff-ui.staff-measures')
				->with('staff_objectives', $staff_objectives)
				->with('staff_user', $staff_user)
				->with('staff', $staff)
				->with('staff_measures', $staff_measures)
				->with('chief_measures', $chief_measures);
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

		$staff_id = Session::get('staff_user_id', 'default');
		$staff = Request::input('StaffID');
		//$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';

		//DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));

		$staff_measure = new StaffMeasure(Request::all());
		$staff_measure->save();

		//Get the max id after saving.
		$staff_measureid = DB::table('staff_measures')->max('StaffMeasureID');

		//Use Eloquent instead! == Inserting into Staff Targets == You forgot target period
		$staff_target = new StaffTarget;
		$staff_target->TargetPeriod = "Not Set";
		$staff_target->StaffMeasureID = $staff_measureid;
		$staff_target->StaffID = $staff;
		$staff_target->UserStaffID = $staff_id;
		$staff_target->save();

		return $staff_measure;

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
		$staff_measure= StaffMeasure::find($id);
 		return $staff_measure;
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


		$staff_measure = StaffMeasure::find($id);
		$staff_measure->update(Request::all());
		$staff_measure->save();
 
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = Request::input('StaffID');
	//	$action = 'Updated a measure: "' . Request::input('UnitMeasureName') . '"';

	//	DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));



		return $staff_measure;



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
