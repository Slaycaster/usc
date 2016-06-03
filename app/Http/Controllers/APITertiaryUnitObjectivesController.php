<?php namespace App\Http\Controllers;

use App\TertiaryUnitObjective;
use App\Perspective;
use App\SecondaryUnitObjective;
use App\TertiaryUnit;
use App\UserTertiaryUnit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APITertiaryUnitObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $id)->select('TertiaryUnitID')->lists('TertiaryUnitID'); //Get the Unit of the user
        
		return TertiaryUnitObjective::where('TertiaryUnitID', '=', $tertiary_unit)
			->with('perspective')
			->with('tertiary_unit')
			->with('secondary_unit_objective')
			->with('user_tertiary_unit')
			->with('user_tertiary_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('tertiary_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->first();
			$tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $user)->get();
			$tertiary_unit_objectives = TertiaryUnitObjective::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();
			
			$secondary_unit_objectives = SecondaryUnitObjective::all();
			return view('tertiary-ui.tertiary-objectives')
				->with('user', $user)
				->with('tertiary_unit_objectives', $tertiary_unit_objectives)
				->with('tertiary_unit', $tertiary_unit)
				->with('secondary_unit_objectives',$secondary_unit_objectives)
				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function secondary_unit_objectives()
	{
		$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->first();
			$tertiary_unit = Unit::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->first();

		return SecondaryUnitObjective::where('SecondaryUnitID','=',$tertiary_unit->SecondaryUnitID)->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = Request::input('TertiaryUnitID');
		$action = 'Added an objective: "' . Request::input('TertiaryUnitObjectiveName') . '"';

		//DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));


		$tertiary_unit_objective = new TertiaryUnitObjective(Request::all());
		$tertiary_unit_objective->save();

		return $tertiary_unit_objective;
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
		$tertiary_unit_objective= TertiaryUnitObjective::find($id);
 		return $tertiary_unit_objective;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		$tertiary_unit_obj = TertiaryUnitObjective::find($id)->with('perspective')->with('secondary_unit_objective')->with('secondary_unit_objective.secondary_unit')->first();
 

		$tertiary_unitid = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = Request::input('TertiaryUnitID');
		/*
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
		*/

		$tertiary_unit_objective = TertiaryUnitObjective::find($id);
		$tertiary_unit_objective->update(Request::all());
		$tertiary_unit_objective->save();


		return $tertiary_unit_objective;

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
