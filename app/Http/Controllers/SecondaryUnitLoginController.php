<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserSecondaryUnit;
use App\SecondaryUnitObjective;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class SecondaryUnitLoginController extends Controller {

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
		if (Session::has('secondary_user_id'))
		{
			$id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $id)
				->with('secondary_unit')
				->first();
			
			$secondary_unit_objectives_count = SecondaryUnitObjective::where('SecondaryUnitID', '=', $user->SecondaryUnitID)
				->count();
			$secondary_unit_measures_count = SecondaryUnitMeasure::where('SecondaryUnitID', '=', $user->SeconadryUnitID)
				->count();
			return view('secondarydashboard')
				->with('secondary_unit_id', $user->SecondaryUnitID)
				->with('user', $user)
				->with('secondary_unit_objectives_count', $secondary_unit_objectives_count)
				->with('secondary_unit_measures_count', $secondary_unit_measures_count)
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
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->first();//dd($user);
			$secondary_unit_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();
			$maxid = SecondaryUnitAccomplishment::max('updated_at');
		
			$updatedby = SecondaryUnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_unit')
				->first();
			//dd($updatedby);
			return view('secondary-unit-ui.secondary-unit-scorecard')
				->with('user', $user)
				->with('secondary_unit_measures',$secondary_unit_measures)
				->with('updatedby',$updatedby);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}


	public function changesecondaryunitpicture()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->with('secondary_unit.unit')
				->first();//dd($user);
			
			return view('secondary-unit-ui.secondary-unit-changeunitpicture')
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
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->with('secondary_unit.unit')
				->first();
			
			return view('secondary-unit-ui.secondary-unit-changeuserpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	
	
}
