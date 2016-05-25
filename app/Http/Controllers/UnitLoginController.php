<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserUnit;
use App\UnitObjective;
use App\UnitMeasure;

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
				->with('unit')
				->first();
			$unit_objectives_count = UnitObjective::where('UnitID', '=', $user->UnitID)
				->count();
			$unit_measures_count = UnitMeasure::where('UnitID', '=', $user->UnitID)
				->count();
			return view('unitdashboard')
				->with('user', $user)
				->with('unit_objectives_count', $unit_objectives_count)
				->with('unit_measures_count', $unit_measures_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	public function scorecard()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $user->UnitID)->get();

			return view('unit-ui.unit-scorecard')
				->with('user', $user)
				->with('unit_measures',$unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changepass()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $user->UnitID)->get();

			return view('unit-ui.unit-changepassword')
				->with('user', $user)
				->with('unit_measures',$unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changeunitpicture()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			
			return view('unit-ui.unit-changeunitpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changeuserpicture()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			
			return view('unit-ui.unit-changeuserpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	
}
