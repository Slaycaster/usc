<?php namespace App\Http\Controllers;


use App\UserChief;
use App\UserSecondaryUnit;


use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class ChiefConfirmPasswordController extends Controller {

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

}
