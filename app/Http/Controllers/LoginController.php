<?php namespace App\Http\Controllers;

//MODELS
use App\UserUnit;
use App\UserChief;
use App\UserStaff;
//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class LoginController extends Controller {

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

			$chief = UserChief::where('UserChiefBadgeNumber','=',$user)
			->where('UserChiefPassword', '=', $pass)
			->first();

			$staff = UserStaff::where('UserStaffBadgeNumber','=',$user)
			->where('UserStaffPassword', '=', $pass)
			->first();

			$unit = UserUnit::where('UserUnitBadgeNumber','=',$user)
			->where('UserUnitPassword', '=', $pass)
			->first();

			if($chief != null)
			{
				

					$credentials = UserChief::where('UserChiefIsActive', 1)
						->where('UserChiefBadgeNumber', '=', $user)
						->where('UserChiefPassword', '=', $pass)
						->first();
					
					if (count($credentials) > 0) {
						Session::put('chief_user_id', $credentials->UserChiefID);

						$id = Session::get('chief_user_id', 'default');
						$time = date('Y-m-d H:i:s');

						
						$ip = $_SERVER['REMOTE_ADDR'];
					
						DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($id, $time, 'Login', $ip ));

					

						return Redirect::to('chief/dashboard');
					}
					else
					{
						Session::flash('message', 'Sorry! Incorrect username/password. Please try again.');
						return Redirect::to('/');
					}
			}

			elseif($staff != null)
			{
				

					$credentials = UserStaff::where('UserStaffIsActive', 1)
						->where('UserStaffBadgeNumber', '=', $user)
						->where('UserStaffPassword', '=', $pass)
						->first();
					
					if (count($credentials) > 0) {
						Session::put('staff_user_id', $credentials->UserStaffID);

						$id = Session::get('staff_user_id', 'default');
						$time = date('Y-m-d H:i:s');

						
						$ip = $_SERVER['REMOTE_ADDR'];
					
						DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($id, $time, 'Login', $ip ));

					

						return Redirect::to('staff/dashboard');
					}
					else
					{
						Session::flash('message', 'Sorry! Incorrect username/password. Please try again.');
						return Redirect::to('/');
					}
			}

			elseif($unit != null)
			{
				

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
			else{
				Session::flash('message', 'Sorry! Incorrect username/password. Please try again.');
						return Redirect::to('/');
			}
		}
	}

	public function doLogout()
	{
		$unit_id = Session::get('unit_user_id', 'default');
		$chief_id = Session::get('chief_user_id', 'default');
		$staff_id = Session::get('staff_user_id', 'default');

		if($unit_id != null)
		{
				
			$time = date('Y-m-d H:i:s');

					
			$ip = $_SERVER['REMOTE_ADDR'];
				
			DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($unit_id, $time, 'Logout', $ip ));

			Session::flush();
			Session::flash('message2', 'Successfully logged out. Have a good day!');
			return Redirect::to('/');
		}

		if($chief_id != null)
		{
				
			$time = date('Y-m-d H:i:s');

					
			$ip = $_SERVER['REMOTE_ADDR'];
				
			//DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($unit_id, $time, 'Logout', $ip ));

			Session::flush();
			Session::flash('message2', 'Successfully logged out. Have a good day!');
			return Redirect::to('/');
		}

		if($staff_id != null)
		{
				
			$time = date('Y-m-d H:i:s');

					
			$ip = $_SERVER['REMOTE_ADDR'];
				
			//DB::insert('insert into user_logs (UnitUserID, LogDateTime, LogType, IPAddress) values (?,?,?,?)', array($unit_id, $time, 'Logout', $ip ));

			Session::flush();
			Session::flash('message2', 'Successfully logged out. Have a good day!');
			return Redirect::to('/');
		}
	}
}
