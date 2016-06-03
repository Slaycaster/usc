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
				->with('tertiaryunit_id', $user->TertiaryUnitID)
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

	
}
