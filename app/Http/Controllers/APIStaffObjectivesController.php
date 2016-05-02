<?php namespace App\Http\Controllers;


use App\Perspective;
use App\StaffObjective;
use App\ChiefObjective;
use App\Staff;
use App\UserStaff;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APIStaffObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('staff_user_id', 'default');
		$staff = UserStaff::where('UserStaffID', '=', $id)->select('StaffID')->lists('StaffID'); //Get the Unit of the user
        
		return StaffObjective::where('StaffID', '=', $staff)
			->with('perspective')
			->with('staff')
			->with('chief_objective')
			->with('user_staff')
			->with('user_staff.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('staff_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('staff_user_id', 'default');
			$user = UserStaff::where('UserStaffID', $id)
				->first();
			$unit = Staff::where('StaffID', '=', $user)->get();
		
			$chief_objectives = ChiefObjective::all();
			
			return view('unit-ui.staff-objectives')
				->with('user', $user)
				->with('chief_objectives', $chief_objectives)
				->with('unit', $unit)
				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$id = Session::get('unit_user_id', 'default');
		$unit = Request::input('StaffID');
		$action = 'Added an objective: "' . Request::input('StaffObjectiveName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));


		$staff_objective = new StaffObjective(Request::all());
		$staff_objective->save();

		return $staff_objective;
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
		$staff_objective= StaffObjective::find($id);
 		return $staff_objective;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		$staff_objective = StaffObjective::find($id);
		$staff_objective->update(Request::all());
		$staff_objective->save();
 

		$id = Session::get('unit_user_id', 'default');
		$unit = Request::input('StaffID');
		$action = 'Updated an Objective: "' . Request::input('StaffObjectiveName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));


		return $staff_objective;

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		UnitObjective::destroy($id);
	}

}
