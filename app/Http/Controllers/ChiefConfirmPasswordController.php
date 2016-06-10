<?php namespace App\Http\Controllers;

use App\UserUnit;
use App\UserStaff;
use App\UserChief;
use App\UserSecondaryUnit;
use App\UserTertiaryUnit;


use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class ChiefConfirmPasswordController extends Controller {

	public function unitConfirmPassword()
	{
		$unit_id = Session::get('unit_user_id', 'default');

		$unit_password = Request::input('getPassword');

		$unit = UserUnit::where('UserUnitID','=',$unit_id)
			->whereRaw("BINARY `UserUnitPassword`= ?",array($unit_password))
			->first();


		if($unit != null)
		{	
			$credentials = UserUnit::where('UserUnitIsActive', 1)
				->where('UserUnitID', '=', $unit_id)
				->where('UserUnitPassword', '=', $unit_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "TRUE";
			 }

		}
		return "FALSE";
	}


	public function staffConfirmPassword()
	{
		$staff_id = Session::get('staff_user_id', 'default');

		$staff_password = Request::input('getPassword');

		$staff = UserStaff::where('UserStaffID','=',$staff_id)
			->whereRaw("BINARY `UserStaffPassword`= ?",array($staff_password))
			->first();


		if($staff != null)
		{	
			$credentials = UserStaff::where('UserStaffIsActive', 1)
				->where('UserStaffID', '=', $staff_id)
				->where('UserStaffPassword', '=', $staff_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "TRUE";
			 }

		}
		return "FALSE";
	}


	public function confirmPassword()
	{
		$chief_id = Session::get('chief_user_id', 'default');

		$chief_password = Request::input('getPassword');

		$chief = UserChief::where('UserChiefID','=',$chief_id)
			->whereRaw("BINARY `UserChiefPassword`= ?",array($chief_password))
			->first();


		if($chief != null)
		{	
			$credentials = UserChief::where('UserChiefIsActive', 1)
				->where('UserChiefID', '=', $chief_id)
				->where('UserChiefPassword', '=', $chief_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "TRUE";
			 }

		}
		return "FALSE";
	}


	public function secondaryUnitConfirmPassword()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');

		$secondary_unit_password = Request::input('getPassword');

		$secondary = UserSecondaryUnit::where('UserSecondaryUnitID','=',$secondary_user_id)
			->whereRaw("BINARY `UserSecondaryUnitPassword`= ?",array($secondary_unit_password))
			->first();


		if($secondary != null)
		{	
			$credentials = UserSecondaryUnit::where('UserSecondaryUnitIsActive', 1)
				->where('UserSecondaryUnitID', '=', $secondary_user_id)
				->where('UserSecondaryUnitPassword', '=', $secondary_unit_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "Password Correct";
			 }

		}
		return "Password Incorrect";
	}


	public function tertiaryUnitConfirmPassword()
	{
		$tertiary_user_id = Session::get('tertiary_user_id', 'default');

		$tertiary_unit_password = Request::input('getPassword');

		$tertiary = UserTertiaryUnit::where('UserTertiaryUnitID','=',$tertiary_user_id)
			->whereRaw("BINARY `UserTertiaryUnitPassword`= ?",array($tertiary_unit_password))
			->first();


		if($tertiary != null)
		{	
			$credentials = UserTertiaryUnit::where('UserTertiaryUnitIsActive', 1)
				->where('UserTertiaryUnitID', '=', $tertiary_user_id)
				->where('UserTertiaryUnitPassword', '=', $tertiary_unit_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "Password Correct";
			 }

		}
		return "Password Incorrect";
	}

}
