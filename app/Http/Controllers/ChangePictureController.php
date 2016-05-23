<?php namespace App\Http\Controllers;

//MODELS
//Our Freelance Models

use App\UserUnit;
use App\UserStaff;
use App\UserChief;
use App\Unit;
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

		if($unit_user != null)
		{
			return $this->changeUnitPicture();
		}
		if($staff_user != null)
		{
			return $this->changeStaffPicture();
		}
		if($chief_user != null)
		{
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
		 	return Redirect::to('unit/changeunitpicture');
		 }
		 else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('unit/changeunitpicture');
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
			 	return Redirect::to('staff/changestaffpicture');
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('staff/changestaffpicture');
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
			 	return Redirect::to('chief/changechiefpicture');
	 	}
	 	else{
	 		Session::flash('upload-error', 'Please select a photo');
	 		return Redirect::to('chief/changechiefpicture');
	 	}
	 }




	
}
