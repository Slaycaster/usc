<?php namespace App\Http\Controllers;

use App\UnitObjective;
use App\Http\Controllers\Controller;
use Request, Session, DB;


class APIUnitObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('unit_user_id', 'default');
		return UnitObjective::with('perspective')->with('unit')->with('user_unit')->with('user_unit.rank')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$id = Session::get('unit_user_id', 'default');
		$action = 'Added an objective: "' . Request::input('UnitObjectiveName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID) values (?,?)', array($action, $id));

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

		$id = Session::get('unit_user_id', 'default');
		$action = 'Updated an Objective: "' . Request::input('UnitObjectiveName') . '"';

		DB::insert('insert into audit_trails (Action, UserUnitID) values (?,?)', array($action, $id));

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
