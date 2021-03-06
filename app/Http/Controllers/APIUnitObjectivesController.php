<?php namespace App\Http\Controllers;

use App\UnitObjective;
use App\Perspective;
use App\StaffObjective;
use App\Unit;
use App\UserUnit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APIUnitObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('unit_user_id', 'default');
		$unit = UserUnit::where('UserUnitID', '=', $id)->select('UnitID')->lists('UnitID'); //Get the Unit of the user
        
		return UnitObjective::where('UnitID', '=', $unit)
			->with('perspective')
			->with('unit')
			->with('staffobjective')
			->with('user_unit')
			->with('user_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('unit_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit = Unit::where('UnitID', '=', $user)->get();
			$unit_objectives = UnitObjective::where('UnitID', '=', $user->UnitID)->get();
			
			$staffobjectives = StaffObjective::all();
			return view('unit-ui.unit-objectives')
				->with('user', $user)
				->with('unit_objectives', $unit_objectives)
				->with('unit', $unit)
				->with('staffobjectives',$staffobjectives)
				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function staff_objectives()
	{
		$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit = Unit::where('UnitID', '=', $user->UnitID)->first();

		return StaffObjective::where('StaffID','=',$unit->StaffID)->get();
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
		$action = 'Added an objective: "' . Request::input('UnitObjectiveName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));


		$unit_objective = new UnitObjective(Request::all());
		$unit_objective->save();

		return $unit_objective;
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
		$unit_objective= UnitObjective::find($id);
 		return $unit_objective;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		$unit_obj = UnitObjective::find($id)->with('perspective')->with('staffobjective')->with('staffobjective.staff')->first();
 

		$unitid = Session::get('unit_user_id', 'default');
		$unit = Request::input('UnitID');

		$new_objectivename = Request::input('UnitObjectiveName');
		$new_perspective = Perspective::find(Request::input('PerspectiveID'))->first();

		$action = 'Updated the Objective: "' . $unit_obj->UnitObjectiveName . '" under "' . $unit_obj->perspective->PerspectiveName;

		if($unit_obj->StaffObjectiveID > 0)
		{
			$action .= ' and is contributory to Staff\'s: "'.$unit_obj->staffobjective->StaffObjectiveName.'" ';
		}

		$action .= 'to: "'.Request::input('UnitObjectiveName').'" under "'. $new_perspective->PerspectiveName . '"';


		if(Request::input('StaffObjectiveID') > 0)
		{
			$new_contributory = StaffObjective::find(Request::input('StaffObjectiveID'))->first();
			$action .= 'and is contributory to Staff\'s: "'.$new_contributory->StaffObjectiveName.'" ';
		}

		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $unitid, $unit));


		$unit_objective = UnitObjective::find($id);
		$unit_objective->update(Request::all());
		$unit_objective->save();


		return $unit_objective;

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
