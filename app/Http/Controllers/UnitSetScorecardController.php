<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect, Session;
use Illuminate\Http\Request;
use App\UserUnit;
use App\UnitObjective;
use App\Perspective;

class UnitSetScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('unit_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit_objectives = UnitObjective::where('UserUnitID', '=', $user->UnitID)->get();
			return view('unit-ui.unit-setscorecard')
				->with('user', $user)
				->with('unit_objectives', $unit_objectives)
				->with('perspectives', $perspectives);
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
