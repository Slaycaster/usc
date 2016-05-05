<?php namespace App\Http\Controllers;

use App\ChiefMeasure;
use App\ChiefTarget;
use App\ChiefObjective;
use App\Chief;
use App\UserChief;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIChiefTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$chief_id = Session::get('chief_user_id', 'default');

		$chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief
        /*
		return ChiefTarget::with('chief_objective')
			->with('chief_measures')
			->with('chief')
			->with('user_chief')
			->with('user_chief.rank')
			->where('ChiefID', '=', $chief)
			->get();
		*/
		return ChiefTarget::with('chief_measure')
			->with('chief_measure.chief_objective')
			->with('user_chief')
			->with('user_chief.rank')
			->where('ChiefID', '=', 1)
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
			
			return view('chief-ui.chief-targets')
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
		
		$chief_target = new ChiefTarget(Request::all());
		$chief_target->save();

		
		return $chief_target;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$chief_target= ChiefTarget::find($id);
 		return $chief_target;
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
	public function updatetarget($id)
	{
		$chief_target = ChiefTarget::find($id);
		$chief_target->update(Request::all());
		$chief_target->save();
 	

		return $chief_target;
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
