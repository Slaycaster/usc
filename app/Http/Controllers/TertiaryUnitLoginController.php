<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserTertiaryUnit;
use App\TertiaryUnitObjective;
use App\TertiaryUnitMeasure;
use App\TertiaryUnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class TertiaryUnitLoginController extends Controller {

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


		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
						
			$tertiary_objectives_count = TertiaryUnitObjective::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			$tertiary_measures_count = TertiaryUnitMeasure::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			return view('tertiaryunitdashboard')
				->with('tertiary_unit_id', $user->TertiaryUnitID)
				->with('user', $user)
				->with('tertiary_objectives_count', $tertiary_objectives_count)
				->with('tertiary_measures_count', $tertiary_measures_count)
				->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));;
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}


	public function scorecard()
	{
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
			
			
			$tertiary_objectives_count = TertiaryUnitObjective::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			$tertiary_measures_count = TertiaryUnitMeasure::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			return view('tertiary-ui.tertiary-scorecard')
				->with('tertiary_unit_id', $user->TertiaryUnitID)
				->with('user', $user)
				->with('tertiary_objectives_count', $tertiary_objectives_count)
				->with('tertiary_measures_count', $tertiary_measures_count)
				->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));;
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changepass()
	{
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();

			return view('tertiary-ui.tertiary-changepassword')
				->with('user', $user)
				->with('tertiary_unit_measures',$tertiary_unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changetertiarypicture()
	{
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();

			return view('tertiary-ui.tertiary-changetertiarypicture')
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
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
		

			return view('tertiary-ui.tertiary-changeuserpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	
}
