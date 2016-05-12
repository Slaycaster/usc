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
		$chief_id = Session::get('chief_user_id', 'default');
		$chief_user = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the user
        
		$data = ChiefObjective::where('ChiefID', '=', $chief_user)
			->with('perspective')
			->with('chief')
			->with('user_chief')
			->with('user_chief.rank')
			->get();

		return json_encode($data);
	}

	
	public function showIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$perspectives = Perspective::all();
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->first();
			$chief = Chief::where('ChiefID', '=', $chief_user)->get();
		
			return view('chief-ui.chief-objectives')
				->with('chief_user', $chief_user)
				->with('chief', $chief)
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

		$chief_id = Session::get('chief_user_id', 'default');
		$chief = Request::input('ChiefID');
		$action = 'Added an objective: "' . Request::input('ChiefObjectiveName') . '"';


		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));



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
 

		$chief_id = Session::get('chief_user_id', 'default');
		$chief = Request::input('ChiefID');
		$action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';


		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));



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
