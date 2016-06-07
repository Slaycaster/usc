<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\SecondaryUnitObjective;
use App\Perspective;
use App\UserSecondaryUnit;
use App\SecondaryUnit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APISecondaryUnitObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$secondaryunit = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_user_id)->select('SecondaryUnitID')->lists('SecondaryUnitID'); //Get the Unit of the user
        
		return SecondaryUnitObjective::where('SecondaryUnitID', '=', $secondaryunit)
			->with('perspective')
			->with('secondary_unit')
			->with('unitobjective')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('secondary_user_id'))
		{
			$perspectives = Perspective::all();
			$secondary_user_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();
			$unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();
			$secondary_unit_objectives = SecondaryUnitObjective::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();
			
		
			return view('secondary-unit-ui.secondary-unit-objectives')
				->with('user', $user)
				->with('secondary_unit_objectives', $secondary_unit_objectives)
				->with('unit', $unit)
				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function unit_objectives()
	{
			$secondary_user_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();
			$unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->first();

		return UnitObjective::where('UnitID','=',$unit->UnitID)->get();
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
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$unit = Request::input('SecondaryUnitID');
		$action = 'Added an objective: "' . Request::input('SecondaryUnitObjectiveName') . '"';

		DB::insert('insert into secondary_audit_trails (Action, UserSecondaryUnitID, SecondaryUnitID) values (?,?,?)', array($action, $secondary_user_id, $unit));


		$secondary_unit_objective = new SecondaryUnitObjective(Request::all());
		$secondary_unit_objective->save();

		return $secondary_unit_objective;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$secondary_unit_objective= SecondaryUnitObjective::find($id);
 		return $secondary_unit_objective;
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

		$secondary_unit_objective = SecondaryUnitObjective::find($id)->with('perspective')->with('unitobjective')->with('unitobjective.unit')->first();
 

		$secondary_unit_id = Session::get('secondary_user_id', 'default');
		$secondary_unit = Request::input('SecondaryUnitID');


		
		$new_perspective = Perspective::find(Request::input('PerspectiveID'))->first();

		$action = 'Updated the Objective: "' . $secondary_unit_objective->SecondaryUnitObjectiveName . '" under "' . $secondary_unit_objective->perspective->PerspectiveName;

		if($secondary_unit_objective->UnitObjectiveID > 0)
		{
			$action .= ' and is contributory to Unit\'s: "'.$secondary_unit_objective->unitobjective->UnitObjectiveName.'" ';
		}


		$action .= ' to: "'.Request::input('SecondaryUnitObjectiveName').'" under "'. $new_perspective->PerspectiveName . '"';

		if(Request::input('UnitObjectiveID') > 0)
		{
			$new_contributory = UnitObjective::find(Request::input('UnitObjectiveID'))->first();
			$action .= 'and is contributory to Unit\'s: "'.$new_contributory->UnitObjectiveName.'" ';
		}

		DB::insert('insert into secondary_audit_trails (Action, UserSecondaryUnitID, SecondaryUnitID) values (?,?,?)', array($action, $secondary_unit_id, $secondary_unit));
	



		$secondary_unit_objective = SecondaryUnitObjective::find($id);
		$secondary_unit_objective->update(Request::all());
		$secondary_unit_objective->save();


		return $secondary_unit_objective;
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
