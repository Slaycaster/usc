<?php namespace App\Http\Controllers;

use App\ChiefMeasure;
use App\Chief;
use App\UserChief;
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

			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();
			
			return view('chief-ui.chief-measures')
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
		//$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';

		//DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));

		$chief_measure = new ChiefMeasure(Request::all());
		$chief_measure->save();
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
		$chief = Request::input('UnitID');
	//	$action = 'Updated a measure: "' . Request::input('UnitMeasureName') . '"';

	//	DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));



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
