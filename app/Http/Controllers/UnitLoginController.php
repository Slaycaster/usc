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

	public function doLogin()
	{
		$rules = array(
			'username'   => 'required', 
			'password'=> 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator -> fails()){
			return Redirect::to('/')
			->withErrors($validator)
			->withInput(Input::except('password')); 
		}
		else
		{
			$user = Input::get('username');
			$pass = Input::get('password');
			$credentials = UserUnit::where('UserUnitIsActive', 1)
				->where('UserUnitBadgeNumber', '=', $user)
				->where('UserUnitPassword', '=', $pass)
				->first();
			
			if (count($credentials) > 0) {
				Session::put('unit_user_id', $credentials->UserUnitID);

				$id = Session::get('unit_user_id', 'default');
				$time = date('Y-m-d H:i:s');

				
				$ip = $_SERVER['REMOTE_ADDR'];
			
				DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($id, $time, 'Login', $ip ));

			

				return Redirect::to('unit/dashboard');
			}
			else
			{
				Session::flash('message', 'Sorry! Incorrect username/password. Please try again.');
				return Redirect::to('/');
			}
		}
	}

	public function doLogout()
	{
		$id = Session::get('unit_user_id', 'default');
		$time = date('Y-m-d H:i:s');

				
		$ip = $_SERVER['REMOTE_ADDR'];
			
		DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($id, $time, 'Logout', $ip ));

		Session::flush();
		Session::flash('message2', 'Successfully logged out. Have a good day!');
		return Redirect::to('/');
	}
}
