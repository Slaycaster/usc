<?php namespace App\Http\Controllers;

//MODELS
use App\UserStaff;
use App\StaffObjective;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class StaffLoginController extends Controller {

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
		if (Session::has('staff_user_id'))
		{
			$id = Session::get('staff_user_id', 'default');
			$user = UserStaff::where('UserStaffID', $id)
				->first();
			$staff_objectives_count = StaffObjective::where('StaffObjectiveID', $user->UnitID)
				->count();
			return view('staffdashboard')
				->with('user', $user)
				->with('staff_objectives_count', $staff_objectives_count);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	
}
