<?php namespace App\Http\Controllers;

//MODELS
//Our Freelance Models
use App\UserChief;
use App\UserStaff;
use App\UserUnit;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class ChangePasswordController extends Controller {

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


	 public function ChangePassword() 
	{
		    $chief_user = Session::get('chief_user_id', 'default');
			$staff_user = Session::get('staff_user_id', 'default');
			$unit_user = Session::get('unit_user_id', 'default');
			
		    $validator = Validator::make(Input::all(),

				array(

					'new_password' 		=> 'required',

					'old_password'	=> 'required',

					'password_again'=> 'required|same:new_password'

					)

			);
	
		    if($validator->fails()) 
			{
				return Redirect::to('unit/changepassword')
				->withErrors($validator);
			} 

		    if($unit_user != null)
		    {
			
					$id = Session::get('unit_user_id', 'default');

					$old_password = DB::table('user_units')->select('UserUnitPassword as old_password')->where('UserUnitID', '=', $id)->get();		

					$units = DB::table('user_units')->where('UserUnitID' ,'=', $id)->get();


					$userunit = DB::table('user_units')->where('UserUnitID' ,'=', $id)->first();

					foreach ($old_password as $value) {

						if (Input::get('old_password') == $value->old_password) 
						{

							DB::table('user_units')->where('UserUnitID', '=', $id)->update(array('UserUnitPassword' => Input::get('new_password')));

							Session::flash('message2', 'Change password success! Your new password is:  '.$userunit->UserUnitPassword);

							return Redirect::to('unit/changepassword');	

						}

						else
						{

							Session::flash('message', 'Invalid old password!');

							return Redirect::to('unit/changepassword');

						}



			}
		 }
	}


	
}
