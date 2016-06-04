<?php namespace App\Http\Controllers;

use App\UserUnit;
use App\UnitObjective;
use App\UnitMeasure;
use App\UnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class SecondaryLoginController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function dashboard()
	{
		if (Session::has('secondary_user_id'))
		{
			$id = Session::get('secondary_user_id', 'default');
			$user = UserUnit::where('UserSecondaryID', $id)
				->with('unit')
				->first();
			
			$secondary_objectives_count = UnitObjective::where('UnitID', '=', $user->UnitID)
				->count();
			$secondary_measures_count = UnitMeasure::where('UnitID', '=', $user->UnitID)
				->count();
			return view('secondarydashboard')
				->with('secondary_id', $user->SecondaryID)
				->with('user', $user)
				->with('secondary_objectives_count', $secondary_objectives_count)
				->with('secondary_measures_count', $secondary_measures_count)
				->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));;
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
