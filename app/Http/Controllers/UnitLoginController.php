<?php namespace App\Http\Controllers;

//MODELS
use App\UserUnit;
use App\UnitObjective;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class UnitLoginController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		if (Session::has('unit_user_id'))
		{
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit_objectives_count = UnitObjective::where('UnitID', '=', $user->UnitID)
				->count();
			return view('unitdashboard')
				->with('user', $user)
				->with('unit_objectives_count', $unit_objectives_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	
}
