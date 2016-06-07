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

		DB::insert('insert into tertiary_audit_trails (Action, UserTertiaryUnitID, TertiaryUnitID) values (?,?,?)', array($action, $id, $tertiary_unit));


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



		$staff_objective2= TertiaryUnitObjective::find($id)->with('perspective')->with('secondary_unit_objective')->with('secondary_unit_objective.secondary_unit')->first();
	
		$staff_id = Session::get('tertiary_user_id', 'default');
		$staff = Request::input('TertiaryUnitID');

		$new_perspective = Perspective::find(Request::input('PerspectiveID'))->first();

		$action = 'Updated the Objective: "' . $staff_objective2->TertiaryUnitObjectiveName . '" under "' . $staff_objective2->perspective->PerspectiveName;

		if($staff_objective2->SecondaryUnitObjectiveID > 0)
		{
			$action .= ' and is contributory to Chief\'s: "'.$staff_objective2->secondary_unit_objective->SecondaryUnitObjectiveName.'" ';
		}


		$action .= ' to: "'.Request::input('TertiaryUnitObjectiveName').'" under "'. $new_perspective->PerspectiveName . '"';

		if(Request::input('SecondaryUnitObjectiveID') > 0)
		{
			$new_contributory = SecondaryUnitObjective::find(Request::input('SecondaryUnitObjectiveID'))->first();
			$action .= 'and is contributory to Chief\'s: "'.$new_contributory->SecondaryUnitObjectiveName.'" ';
		}

		DB::insert('insert into tertiary_audit_trails (Action, UserTertiaryUnitID, TertiaryUnitID) values (?,?,?)', array($action, $staff_id, $staff));
	



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
