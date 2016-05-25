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

	public function changepass()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			$staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();

			return view('staff-ui.staff-changepassword')
				->with('staff_user', $staff_user)
				->with('staff_measures',$staff_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changestaffpicture()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			

			return view('staff-ui.staff-changestaffpicture')
				->with('staff_user', $staff_user);
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


			//TARGETS
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




			//CONTRIBUTORIES
			$januaryunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//STAFF ACCOMPLISHMENTS
			$januarystaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarystaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maystaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junestaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julystaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$auguststaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberstaff = DB::table('staff_accomplishments')
			->where('StaffID', '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//STAFF ACCOMP PLUS CONTRIBUTORIES

			$januaryaccomp = $januarystaff + $januaryunit;
			$februaryaccomp = $februarystaff + $februaryunit;
			$marchaccomp = $marchstaff + $marchunit;
			$aprilaccomp = $januarystaff + $januaryunit;
			$mayaccomp = $maystaff + $mayunit;
			$juneaccomp = $junestaff + $juneunit;
			$julyaccomp = $julystaff + $julyunit;
			$augustaccomp = $auguststaff + $augustunit;
			$septemberaccomp = $septemberstaff + $septemberunit;
			$octoberaccomp = $octoberstaff + $octoberunit;
			$novemberaccomp = $novemberstaff + $novemberunit;
			$decemberaccomp = $decemberstaff + $decemberunit;



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
