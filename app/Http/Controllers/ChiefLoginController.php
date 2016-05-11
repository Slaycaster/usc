<?php namespace App\Http\Controllers;

//MODELS
//Our Freelance Models
use App\UserChief;
use App\ChiefObjective;
use App\ChiefMeasure;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class ChiefLoginController extends Controller {

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
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
			$chief_objectives_count = ChiefObjective::where('ChiefID', $chief_user->ChiefID)
				->count();
			$chief_measures_count = ChiefMeasure::where('ChiefID', $chief_user->ChiefID)
				->count();
			return view('chiefdashboard')
				->with('chief_user', $chief_user)
				->with('chief_objectives_count', $chief_objectives_count)
				->with('chief_measures_count', $chief_measures_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	public function scorecard()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
			$chief_objectives_count = ChiefObjective::where('ChiefID', $chief_user->ChiefID)
				->count();
			$chief_measures_count = ChiefMeasure::where('ChiefID', $chief_user->ChiefID)
				->count();
			return view('chief-ui.chief-scorecard')
				->with('chief_user', $chief_user)
				->with('chief_objectives_count', $chief_objectives_count)
				->with('chief_measures_count', $chief_measures_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	
}
