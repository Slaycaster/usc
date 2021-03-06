<?php namespace App\Http\Controllers;

//Models
use App\ChiefMeasure;
use App\ChiefObjective;
use App\Chief;
use App\UserChief;
use App\ChiefTarget;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APIChiefMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$chief_id = Session::get('chief_user_id', 'default');

		$chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief
        
		return ChiefMeasure::where('ChiefID', '=', $chief)
			->with('chief_objective')
			->with('chief')
			->with('user_chief')
			->with('user_chief.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();

			$chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
			$chief_objectives = ChiefObjective::all();
			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();
			
			return view('chief-ui.chief-measures')
				->with('chief_objectives', $chief_objectives)
				->with('chief_user', $chief_user)
				->with('chief', $chief)
				->with('chief_measures', $chief_measures);
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

		$chief_id = Session::get('chief_user_id', 'default');
		$chief = Request::input('ChiefID');
		$action = 'Added a measure: "' . Request::input('ChiefMeasureName') . '"';

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));

		$chief_measure = new ChiefMeasure(Request::all());
		$chief_measure->save();
	
		$chief_measureid = DB::table('chief_measures')->max('ChiefMeasureID');

		/* Trash
		DB::insert('insert into chief_targets (ChiefMeasureID, ChiefID, UserChiefID) values (?,?,?)', array($chief_measureid, $chief, $chief_id,));
		*/

		//Use Eloquent instead! == Inserting into Chief Targets == You forgot target period
		$chief_target = new ChiefTarget;
		$chief_target->TargetPeriod = "Not Set";
		$chief_target->ChiefMeasureID = $chief_measureid;
		$chief_target->ChiefID = $chief;
		$chief_target->UserChiefID = $chief_id;
		$chief_target->save();

		return $chief_measure;

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
		$chief_measure= ChiefMeasure::find($id);
 		return $chief_measure;
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

		$chief_measure = ChiefMeasure::find($id);
		$chief_measure->update(Request::all());
		$chief_measure->save();
 
		$chief_id = Session::get('chief_user_id', 'default');
		$chief = Request::input('ChiefID');
	    $action = 'Updated a measure: "' . Request::input('ChiefMeasureName') . '"';

		DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));



		return $chief_measure;

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
