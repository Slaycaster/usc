<?php namespace App\Http\Controllers;

//MODELS
use App\UserChief;
use App\ChiefObjective;

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
				->first();
			$chief_objectives_count = ChiefObjective::where('ChiefID', $chief_user->ChiefID)
				->count();
			return view('chiefdashboard')
				->with('chief_user', $chief_user)
				->with('chief_objectives_count', $chief_objectives_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	
}
