<?php namespace App\Http\Controllers;

use App\UnitMeasure;
use App\UserUnit;
use App\Unit;
use App\Http\Controllers\Controller;
use Request, Session;


class APIUnitMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$id = Session::get('unit_user_id', 'default');
		return UnitMeasure::where('UnitID', '=', $id)->with('unit')->with('user_unit')->with('user_unit.rank')->get();
	}

	public function showIndex()
	{
		if (Session::has('unit_user_id'))
		{
			$id = Session::get('unit_user_id', 'default');
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
		$unit_measure = new UnitMeasure(Request::all());
		$unit_measure->save();
		return $unit_measure;

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
		$unit_measure= UnitMeasure::find($id);
 		return $unit_measure;
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
		$unit_measure = UnitMeasure::find($id);
		$unit_measure->update(Request::all());
		$unit_measure->save();
 
		return $unit_measure;

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
