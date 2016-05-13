<?php namespace App\Http\Controllers;

//Models
use App\StaffTarget;
use App\StaffMeasure;
use App\StaffObjective;
use App\Staff;
use App\UserStaff;
use App\StaffAccomplishment;
use App\StaffOwner;
use App\StaffInitiative;
use App\StaffFunding;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIStaffScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();


		$staff_id = Session::get('staff_user_id', 'default'); //get the UserstaffID stored in session.

		$staff = UserChief::where('UserStaffID', '=', $staff_id)->select('StaffID')->lists('StaffID'); //Get the Unit of the chief

		$currentYear = date("Y");		
		
		$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$staff_objectives = StaffObjective::all();
			$staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();
	
		return StaffTarget::with('staff_measure')
			->with('staff_measure.staff_objective')
			->with('staff_measure.staff_owners')
			->with('staff_measure.staff_fundings')
			->with('staff_measure.staff_initiatives')
			->with('staff_measure.staff_accomplishments')
			->with('user_staff')
			->with('user_staff.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('StaffID', '=', $staff_id)
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
		//
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
