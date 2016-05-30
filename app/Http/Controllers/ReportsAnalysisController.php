<?php namespace App\Http\Controllers;


//Models
use App\Unit;
use App\UserUnit;

use App\Staff;
use App\UserStaff;

use App\Chief;
use App\UserChief;


use Barryvdh\DomPDF\Facade as PDF;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

	
class ReportsAnalysisController extends Controller 
{
	// public function unitIndex()
	// {
	// 	if (Session::has('unit_user_id'))
	// 	{	
	// 		$unit_id = Session::get('unit_user_id', 'default');
	// 		$user = UserUnit::where('UserUnitID', '=', $unit_id)
	// 						->with('unit')
	// 						->first();

	// 		$unit = unit::where('UnitID', '=', $user->UnitID)->first();
	// 		$year = array();

	// 		for($y = date("Y"); $y >= 2011; $y--)
	// 		{
	// 			array_push($year, $y);
	// 		}
			
	// 		return view('unit-ui.unit-reports')
	// 				->with('unit', $unit)
	// 				->with('user', $user)
	// 				->with('years', $year);
	// 	}
	// 	else
	// 	{
	// 		Session::flash('message', 'Please login first!');
	// 		return Redirect::to('/');
	// 	}
	// }

	// public function staffIndex()
	// {
	// 	if (Session::has('staff_user_id'))
	// 	{
	// 		$staff_id = Session::get('staff_user_id', 'default');
	// 		$staff_user = UserStaff::where('UserstaffID', '=', $staff_id)
	// 			->first();

	// 		$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
	// 		$year = array();

	// 		for($y = date("Y"); $y >= 2011; $y--)
	// 		{
	// 			array_push($year, $y);
	// 		}
			
	// 		return view('staff-ui.staff-reports')
	// 			->with('staff_user', $staff_user)
	// 			->with('staff', $staff)
	// 			->with('years', $year);
	// 	}
	// 	else
	// 	{
	// 		Session::flash('message', 'Please login first!');
	// 		return Redirect::to('/');
	// 	}
	// }

	public function chiefIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
									->first();
			$chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
			
			return view('chief-ui.chief-analysis')
					->with('chief_user', $chief_user)
					->with('chief', $chief);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}
}