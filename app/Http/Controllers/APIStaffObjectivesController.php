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
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->lists('StaffID'); //Get the Unit of the user
        
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
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->first();
			$staff = Staff::where('StaffID', '=', $staff_user)->get();
		
			$chief_objectives = ChiefObjective::all();
			
			return view('staff-ui.staff-objectives')
				->with('staff_user', $staff_user)
				->with('chief_objectives', $chief_objectives)
				->with('staff', $staff)
				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function chief_objectives()
	{
		return ChiefObjective::all();
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
		$action = 'Added an objective: "' . Request::input('StaffObjectiveName') . '"';

		DB::insert('insert into staff_audit_trails (Action, UserStaffID,  StaffID) values (?,?,?)', array($action, $staff_id, $staff));


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
    	$staff_objective = StaffObjective::find($id);
		//$staff_objective= StaffObjective::find($id)->with('perspective')->first();
		//$staff_objective = StaffObjective::find($id)->with('perspective')->with('chief_objective')->with('chief_objective.chief')->first();
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
		/*
		$staff_objective = DB::table('staff_objectives')
		->join('perspectives', 'staff_objectives.PerspectiveID', '=', 'perspectives.PerspectiveID')
		->join('chief_objectives', 'staff_objectives.ChiefObjectiveID', '=', 'chief_objectives.ChiefObjectiveID')
		->join('chiefs', 'chief_objectives.ChiefID', '=', 'chiefs.ChiefID')
		->where('StaffObjectiveID', '=', $id)
		->select('PerspectiveName', 'StaffObjectiveName', 'ChiefObjectiveName', 'ChiefAbbreviation')
		->first();
		*/

		$staff_objective2= StaffObjective::find($id)->with('perspective')->with('chief_objective')->with('chief_objective.chief')->first();
	
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = Request::input('StaffID');

		$new_perspective = Perspective::find(Request::input('PerspectiveID'))->first();

		$action = 'Updated the Objective: "' . $staff_objective2->StaffObjectiveName . '" under "' . $staff_objective2->perspective->PerspectiveName;

		if($staff_objective2->ChiefObjectiveID > 0)
		{
			$action .= ' and is contributory to Chief\'s: "'.$staff_objective2->chief_objective->ChiefObjectiveName.'" ';
		}


		$action .= 'to: "'.Request::input('StaffObjectiveName').'" under "'. $new_perspective->PerspectiveName . '"';

		if(Request::input('ChiefObjectiveID') > 0)
		{
			$new_contributory = ChiefObjective::find(Request::input('ChiefObjectiveID'))->first();
			$action .= 'and is contributory to Chief\'s: "'.$new_contributory->ChiefObjectiveName.'" ';
		}

		DB::insert('insert into staff_audit_trails (Action, UserStaffID, StaffID) values (?,?,?)', array($action, $staff_id, $staff));
	
		$staff_objective = StaffObjective::find($id);
		$staff_objective->update(Request::all());
		$staff_objective->save();

 
 		// for new objectives in the controller






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
