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
			->get();
	}

	public function showIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit = Unit::where('UnitID', '=', $user)->get();
			$unit_measures = UnitMeasure::where('UnitID', '=', $user->UnitID)->get();
			
			return view('unit-ui.unit-measures')
				->with('user', $user)
				->with('unit', $unit)
				->with('unit_measures', $unit_measures);
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
		//
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
		//
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
