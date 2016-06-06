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
		    $chief_user = Session::get('chief_user_id');
			$staff_user = Session::get('staff_user_id');
			$unit_user = Session::get('unit_user_id');
			$tertiary_user = Session::get('tertiary_user_id');
		
		    $validator = Validator::make(Input::all(),

				array(

					'new_password' 		=> 'required|min:7',

					'old_password'	=> 'required',

					'password_again'=> 'required|same:new_password'

					)

			);

			if($tertiary_user != null)
		    {
							
					if($validator->fails()) 
					{
						return Redirect::to('tertiary_unit/changepassword')
						->withErrors($validator);
					} 

					$id = Session::get('tertiary_user_id', 'default');

					$old_password = DB::table('user_tertiary_units')->select('UserTertiaryUnitPassword as old_password')->where('UserTertiaryUnitID', '=', $id)->get();		

					$tertiaries = DB::table('user_tertiary_units')->where('UserTertiaryUnitID' ,'=', $id)->get();

					foreach ($old_password as $value) {

						if (Input::get('old_password') == $value->old_password) 
						{

							DB::table('user_tertiary_units')->where('UserTertiaryUnitID', '=', $id)->update(array('UserTertiaryUnitPassword' => Input::get('new_password')));
							
							$usertertiary = DB::table('user_tertiary_units')->where('UserTertiaryUnitID' ,'=', $id)->first();

							Session::flash('message2', 'Change password success! Your new password is:  '.$usertertiary->UserTertiaryUnitPassword);

							return Redirect::to('tertiary_unit/changepassword');	

						}

						else
						{

							Session::flash('message', 'Invalid old password!');

							return Redirect::to('tertiary_unit/changepassword');

						}

					}

			}

			
		    if($unit_user != null)
		    {
				    if($validator->fails()) 
					{
						return Redirect::to('unit/changepassword')
						->withErrors($validator);
					} 
			
					$id = Session::get('unit_user_id', 'default');

					$old_password = DB::table('user_units')->select('UserUnitPassword as old_password')->where('UserUnitID', '=', $id)->get();		

					$units = DB::table('user_units')->where('UserUnitID' ,'=', $id)->get();

					foreach ($old_password as $value) {

						if (Input::get('old_password') == $value->old_password) 
						{

							DB::table('user_units')->where('UserUnitID', '=', $id)->update(array('UserUnitPassword' => Input::get('new_password')));

							$userunit = DB::table('user_units')->where('UserUnitID' ,'=', $id)->first();

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



			if($staff_user != null)
		    {
							
					if($validator->fails()) 
					{
						return Redirect::to('staff/changepassword')
						->withErrors($validator);
					} 

					$id = Session::get('staff_user_id', 'default');

					$old_password = DB::table('user_staffs')->select('UserStaffPassword as old_password')->where('UserStaffID', '=', $id)->get();		

					$staffs = DB::table('user_staffs')->where('UserStaffID' ,'=', $id)->get();

					foreach ($old_password as $value) {

						if (Input::get('old_password') == $value->old_password) 
						{

							DB::table('user_staffs')->where('UserStaffID', '=', $id)->update(array('UserStaffPassword' => Input::get('new_password')));
							
							$userstaff = DB::table('user_staffs')->where('UserStaffID' ,'=', $id)->first();

							Session::flash('message2', 'Change password success! Your new password is:  '.$userstaff->UserStaffPassword);

							return Redirect::to('staff/changepassword');	

						}

						else
						{

							Session::flash('message', 'Invalid old password!');

							return Redirect::to('staff/changepassword');

						}

					}

			}


			if($chief_user != null)
		    {
							
					if($validator->fails()) 
					{
						return Redirect::to('chief/changepassword')
						->withErrors($validator);
					} 

					$id = Session::get('chief_user_id', 'default');

					$old_password = DB::table('user_chiefs')->select('UserChiefPassword as old_password')->where('UserChiefID', '=', $id)->get();		

					$chiefs = DB::table('user_chiefs')->where('UserChiefID' ,'=', $id)->get();

					foreach ($old_password as $value) {

						if (Input::get('old_password') == $value->old_password) 
						{

							DB::table('user_chiefs')->where('UserChiefID', '=', $id)->update(array('UserChiefPassword' => Input::get('new_password')));
							
							$userchief = DB::table('user_chiefs')->where('UserChiefID' ,'=', $id)->first();

							Session::flash('message2', 'Change password success! Your new password is:  '.$userchief->UserChiefPassword);

							return Redirect::to('chief/changepassword');	

						}

						else
						{

							Session::flash('message', 'Invalid old password!');

							return Redirect::to('chief/changepassword');

						}

					}

			}
	}


	
}
