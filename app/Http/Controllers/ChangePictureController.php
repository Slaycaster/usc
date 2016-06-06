<?php namespace App\Http\Controllers;

//MODELS
//Our Freelance Models

use App\UserUnit;
use App\UserSecondaryUnit;
use App\UserStaff;
use App\UserChief;
use App\Unit;
use App\SecondaryUnit;
use App\Staff;
use App\Chief;
//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class ChangePictureController extends Controller {

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

	public function changePicture()
	{
		$chief_user = Session::get('chief_user_id');
		$staff_user = Session::get('staff_user_id');
		$unit_user = Session::get('unit_user_id');
		$secondary_user = Session::get('secondary_user_id');

		if($unit_user != null)
		{
			if(Input::get('userpicture') == '1')
			{
				return $this->changeUserUnitPicture();
			}

			return $this->changeUnitPicture();
		}
		if($secondary_user != null)
		{
			if(Input::get('userpicture') == '1')
			{
				return $this->changeUserSecondaryUnitPicture();
			}

			return $this->changeSecondaryUnitPicture();
		}
		if($staff_user != null)
		{
			if(Input::get('userpicture') == '1')
			{
				return $this->changeUserStaffPicture();
			}

			return $this->changeStaffPicture();
		}
		if($chief_user != null)
		{
			if(Input::get('userpicture') == '1')
			{
				return $this->changeUserChiefPicture();
			}

			return $this->changeChiefPicture();
		}


				
	}


	 public function changeUnitPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
		 	if($_FILES['picturepath']['size'] > 1048576){
	  			//You can not upload this file
	  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
	  			return Redirect::to('unit/changeunitpicture');

			}
		 	$unitid = Input::get('unitid');

		 	$file = Input::file('picturepath')->getClientOriginalName();
		 	
		 	$unit = Unit::find($unitid);

		 	$file = $unit->PicturePath;

		 	$destinationPath = 'uploads/unitpictures/cropped';
		 	Input::file('picturepath')->move($destinationPath, $file);
		 	
		 	$unit->PicturePath = $file;
		 	$unit->save();

		 	Session::flash('upload-success', 'Unit Picture successfully updated!');
		 	

		 	$unit_id = Session::get('unit_user_id', 'default');
		 	$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			
			return view('unit-ui.unit-changeunitpicture')
				->with('user', $user);
		 }
		 else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('unit/changeunitpicture');
	 	}
	 }

	 public function changeUserUnitPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
		 	if($_FILES['picturepath']['size'] > 1048576){
	  			//You can not upload this file
	  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
	  			return Redirect::to('unit/changeuserpicture');

			}
		 	$unitid = Input::get('unitid');

		 	$file = Input::file('picturepath')->getClientOriginalName();
		 	
		 	$userunit = UserUnit::find($unitid);

		 	$file = $userunit->UserUnitPicturePath;

		 	$destinationPath = 'uploads/userpictures/unit/cropped';
		 	Input::file('picturepath')->move($destinationPath, $file);
		 	
		 	$userunit->UserUnitPicturePath = $file;
		 	$userunit->save();

		 	Session::flash('upload-success', 'Your Picture successfully updated!');
		 	return Redirect::to('unit/changeuserpicture');
		 }
		 else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('unit/changeuserpicture');
	 	}
	 }

	 public function changeSecondaryUnitPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
		 	if($_FILES['picturepath']['size'] > 1048576){
	  			//You can not upload this file
	  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
	  			return Redirect::to('secondaryunit/changesecondaryunitpicture');

			}
		 	$secondaryunitid = Input::get('secondaryunitid');

		 	$file = Input::file('picturepath')->getClientOriginalName();
		 	
		 	$secondaryunit = SecondaryUnit::find($secondaryunitid);

		 	$file = $secondaryunit->PicturePath;

		 	$destinationPath = 'uploads/secondaryunitpictures/cropped';
		 	Input::file('picturepath')->move($destinationPath, $file);

		 	$secondaryunit->PicturePath = $file;
		 	$secondaryunit->save();

		 	Session::flash('upload-success', 'Secondary Unit Picture successfully updated!');

			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->with('secondary_unit.unit')
				->first();//dd($user);
			
			return view('secondary-unit-ui.secondary-unit-changeunitpicture')
				->with('user', $user);
		 }
		 else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('secondaryunit/changesecondaryunitpicture');
	 	}
	 }

	 public function changeUserSecondaryUnitPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
		 	if($_FILES['picturepath']['size'] > 1048576){
	  			//You can not upload this file
	  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
	  			return Redirect::to('secondaryunit/changeuserpicture');

			}
		 	$secondaryunitid = Input::get('secondaryunitid');

		 	$file = Input::file('picturepath')->getClientOriginalName();
		 	
		 	$usersecondaryunit = UserSecondaryUnit::find($secondaryunitid);

		 	$file = $usersecondaryunit->UserSecondaryUnitPicturePath;

		 	$destinationPath = 'uploads/userpictures/secondary/cropped';
		 	Input::file('picturepath')->move($destinationPath, $file);
		 	
		 	$usersecondaryunit->UserSecondaryUnitPicturePath = $file;
		 	$usersecondaryunit->save();

		 	Session::flash('upload-success', 'Your Picture successfully updated!');
		 	return Redirect::to('secondaryunit/changeuserpicture');
		 }
		 else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('secondaryunit/changeuserpicture');
	 	}
	 }

	 public function changeStaffPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
			 	if($_FILES['picturepath']['size'] > 1048576){
		  			//You can not upload this file
		  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
		  			return Redirect::to('staff/changestaffpicture');

				}
			 	$staffid = Input::get('staffid');

			 	$file = Input::file('picturepath')->getClientOriginalName();
			 	
			 	$staff = Staff::find($staffid);

			 	$file = $staff->PicturePath;

			 	$destinationPath = 'uploads/staffpictures/cropped';
			 	Input::file('picturepath')->move($destinationPath, $file);
			 	
			 	$staff->PicturePath = $file;
			 	$staff->save();

			 	Session::flash('upload-success', 'Staff Picture successfully updated!');
			
			 	$staff_id = Session::get('staff_user_id', 'default');
			 	$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			

			return view('staff-ui.staff-changestaffpicture')
				->with('staff_user', $staff_user);
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('staff/changestaffpicture');
	 	}
	 }

	 public function changeUserStaffPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
			 	if($_FILES['picturepath']['size'] > 1048576){
		  			//You can not upload this file
		  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
		  			return Redirect::to('staff/changeuserpicture');

				}
			 	$staffid = Input::get('staffid');

			 	$file = Input::file('picturepath')->getClientOriginalName();
			 	
			 	$userstaff = UserStaff::find($staffid);

			 	$file = $userstaff->UserStaffPicturePath;

			 	$destinationPath = 'uploads/userpictures/unit/cropped';
			 	Input::file('picturepath')->move($destinationPath, $file);
			 	
			 	$userstaff->UserStaffPicturePath = $file;
			 	$userstaff->save();

			 	Session::flash('upload-success', 'Your Picture successfully updated!');
			 	return Redirect::to('staff/changeuserpicture');
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('staff/changeuserpicture');
	 	}
	 }

	 public function changeChiefPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
			 	if($_FILES['picturepath']['size'] > 1048576){
		  			//You can not upload this file
		  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
		  			return Redirect::to('chief/changechiefpicture');

				}
			 	$chiefid = Input::get('chiefid');

			 	$file = Input::file('picturepath')->getClientOriginalName();
			 	
			 	$chief = Chief::find($chiefid);

			 	$file = $chief->PicturePath;

			 	$destinationPath = 'uploads/chiefpictures/cropped';
			 	Input::file('picturepath')->move($destinationPath, $file);
			 	
			 	$chief->PicturePath = $file;
			 	$chief->save();

			 	Session::flash('upload-success', 'Chief Picture successfully updated!');
			 	
			 	$chief_id = Session::get('chief_user_id', 'default');
			 	$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
		

			return view('chief-ui.chief-changechiefpicture')
				->with('chief_user', $chief_user);
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('chief/changechiefpicture');
	 	}
	 }

	 public function changeUserChiefPicture()
	 {
	 	if(Input::file('picturepath')!= null)
	 	{
			 	if($_FILES['picturepath']['size'] > 1048576){
		  			//You can not upload this file
		  			Session::flash('upload-error', 'File exceeded 1mb file upload limit. Try compressing the image and try again');
		  			return Redirect::to('chief/changeuserpicture');

				}
			 	$chiefid = Input::get('chiefid');

			 	$file = Input::file('picturepath')->getClientOriginalName();
			 	
			 	$userchief = UserChief::find($chiefid);

			 	$file = $userchief->UserChiefPicturePath;

			 	$destinationPath = 'uploads/userpictures/unit/cropped';
			 	Input::file('picturepath')->move($destinationPath, $file);
			 	
			 	$userchief->UserChiefPicturePath = $file;
			 	$userchief->save();

			 	Session::flash('upload-success', 'Your Picture successfully updated!');
			 	return Redirect::to('chief/changeuserpicture');
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('chief/changeuserpicture');
	 	}
	 }




	
}
