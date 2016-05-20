<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserStaff;
use App\StaffObjective;
use App\StaffMeasure;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

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
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			$staff_objectives_count = StaffObjective::where('StaffID', $staff_user->StaffID)
				->count();
			$staff_measures_count = StaffMeasure::where('StaffID', $staff_user->StaffID)
				->count();
			return view('staffdashboard')
				->with('staff_id',$staff_id)
				->with('staff_user', $staff_user)
				->with('staff_objectives_count', $staff_objectives_count)
				->with('staff_measures_count', $staff_measures_count)
				->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));;
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	public function scorecard()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			$staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();

			return view('staff-ui.staff-scorecard')
				->with('staff_user', $staff_user)
				->with('staff_measures',$staff_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}


	public function bargraph()
		{

			
			$year = $_REQUEST['year'];
			$staff_id = $_REQUEST['staff_id'];

			$january = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JanuaryTarget');

			$february = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('FebruaryTarget');

			$march = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MarchTarget');

			$april = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AprilTarget');

			$may = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MayTarget');

			$june = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JuneTarget');

			$july = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JulyTarget');

			$august = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AugustTarget');

			$september = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('SeptemberTarget');

			$october = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('OctoberTarget');

			$november = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('NovemberTarget');

			$december = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('DecemberTarget');





			$januaryaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberaccomp = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			$targetaccomp = array(
				  array("January", $january, $januaryaccomp),
				  array("February",$february, $februaryaccomp),
				  array("March", $march, $marchaccomp),
				  array("April", $april, $aprilaccomp),
				  array("May", $may, $mayaccomp),
				  array("June", $june, $juneaccomp),
				  array("July", $july, $julyaccomp),
				  array("August", $august, $augustaccomp),
				  array("September", $september, $septemberaccomp),
				  array("October", $october, $octoberaccomp),
				  array("November", $november, $novemberaccomp),
				  array("December", $december, $decemberaccomp)
				  );
			

			return Response::json($targetaccomp);
		}
	
}
