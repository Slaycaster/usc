<?php namespace App\Http\Controllers;


use App\Perspective;
use App\ChiefObjective;
use App\Staff;
use App\Chief;
use App\UserChief;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APIChiefObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('chief_user_id', 'default');
		$chief = UserChief::where('UserChiefID', '=', $id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the user
        
		return ChiefObjective::where('ChiefID', '=', $chief)
			->with('perspective')
			->with('chief')
			->with('user_chief')
			->with('user_chief.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('chief_user_id', 'default');
			$chief = UserChief::where('UserChiefID', $id)
				->first();
			$unit = Chief::where('ChiefID', '=', $chief)->get();
		
		
			
			return view('unit-ui.chief-objectives')
				->with('chief', $chief)
			
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

		$id = Session::get('chief_user_id', 'default');
		$unit = Request::input('ChiefID');
		$action = 'Added an objective: "' . Request::input('ChiefObjectiveName') . '"';

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $id, $unit));


		$chief_objective = new ChiefObjective(Request::all());
		$chief_objective->save();

		return $chief_objective;
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
		$chief_objective = ChiefObjective::find($id);
 		return $chief_objective;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		$chief_objective = ChiefObjective::find($id);
		$chief_objective->update(Request::all());
		$chief_objective->save();
 

		$id = Session::get('chief_user_id', 'default');
		$unit = Request::input('ChiefID');
		$action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $id, $unit));


		return $chief_objective;

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
