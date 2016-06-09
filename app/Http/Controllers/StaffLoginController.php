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
				->with('staff_id',$staff_user->StaffID)
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

	public function changeuserpicture()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', $staff_id)
				->with('staff')
				->first();
			

			return view('staff-ui.staff-changeuserpicture')
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




			// Unit CONTRIBUTORIES
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




			//Secondary Unit CONTRIBUTORIES
			$januarysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junesecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octobersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');





			//Tertiary Unit CONTRIBUTORIES
			$januarytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchtertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$apriltertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junetertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augusttertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octobertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('staff_measures.StaffID' , '=', $staff_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//STAFF ACCOMP PLUS CONTRIBUTORIES

			$januaryaccomp = $januarystaff + $januaryunit + $januarysecondary + $januarytertiary;
			$februaryaccomp = $februarystaff + $februaryunit + $februarysecondary + $februarytertiary;
			$marchaccomp = $marchstaff + $marchunit + $marchsecondary + $marchtertiary;
			$aprilaccomp = $aprilstaff + $aprilunit + $aprilsecondary + $apriltertiary;
			$mayaccomp = $maystaff + $mayunit + $maysecondary + $maytertiary;
			$juneaccomp = $junestaff + $juneunit + $junesecondary + $junetertiary;
			$julyaccomp = $julystaff + $julyunit + $julysecondary + $julytertiary;
			$augustaccomp = $auguststaff + $augustunit + $augustsecondary + $augusttertiary;
			$septemberaccomp = $septemberstaff + $septemberunit + $septembersecondary + $septembertertiary;
			$octoberaccomp = $octoberstaff + $octoberunit + $octobersecondary + $octobertertiary;
			$novemberaccomp = $novemberstaff + $novemberunit + $novembersecondary + $novembertertiary;
			$decemberaccomp = $decemberstaff + $decemberunit + $decembersecondary + $decembertertiary;



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



		public function donutgraph()
		{

			
			$year = $_REQUEST['year'];
			$staff_id = $_REQUEST['staff_id'];


			/*$scorecards = DB::table('unit_accomplishments')
			->join('unit_targets', 'unit_accomplishments.UnitAccomplishmentID', '=', 'unit_targets.UnitAccomplishmentID')
			->join('unit_measures' , 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->where('unit_measures.UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->get();*/



			//unit targets & accomplishments
			$units = DB::table('staff_measures')
			->join('staff_targets', 'staff_measures.StaffMeasureID', '=', 'staff_targets.StaffMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->join('unit_measures', 'staff_measures.StaffMeasureID', '=', 'unit_measures.StaffMeasureID')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->where('staff_measures.StaffID', '=', $staff_id)
			->whereYear('staff_targets.TargetDate', '=', date($year))
			->whereNotIn('unit_measures.UnitMeasureID', function($q2)
						{

							$q2->select('UnitMeasureID')->from('secondary_unit_measures')
								->where('UnitMeasureID', '!=', 0);
						})
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit', 'staff_measures.StaffMeasureID as staffmeasureid' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.FebruaryAccomplishment as FebruaryStaff' , 'staff_accomplishments.MarchAccomplishment as MarchStaff' , 'staff_accomplishments.AprilAccomplishment as AprilStaff' , 'staff_accomplishments.MayAccomplishment as MayStaff' , 'staff_accomplishments.JuneAccomplishment as JuneStaff' , 'staff_accomplishments.JulyAccomplishment as JulyStaff' , 'staff_accomplishments.AugustAccomplishment as AugustStaff' , 'staff_accomplishments.SeptemberAccomplishment as SeptemberStaff' , 'staff_accomplishments.OctoberAccomplishment as OctoberStaff' , 'staff_accomplishments.NovemberAccomplishment as NovemberStaff', 'staff_accomplishments.DecemberAccomplishment as DecemberStaff', 'staff_targets.JanuaryTarget as Januarytarget' , 'staff_targets.FebruaryTarget as Februarytarget' , 'staff_targets.MarchTarget as Marchtarget' , 'staff_targets.AprilTarget as Apriltarget' , 'staff_targets.MayTarget as Maytarget' , 'staff_targets.JuneTarget as Junetarget' , 'staff_targets.JulyTarget as Julytarget' , 'staff_targets.AugustTarget as Augusttarget' , 'staff_targets.SeptemberTarget as Septembertarget' , 'staff_targets.OctoberTarget as Octobertarget' , 'staff_targets.NovemberTarget as Novembertarget' , 'staff_targets.DecemberTarget as Decembertarget')
			->get();


			//staff targets & accomplishments
			$staffs = DB::table('staff_measures')
			->join('staff_targets', 'staff_measures.StaffMeasureID', '=', 'staff_targets.StaffMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->where('staff_measures.StaffID', '=', $staff_id)
			->whereYear('staff_targets.TargetDate', '=', date($year))
			->whereNotIn('staff_measures.StaffMeasureID', function($q2)
						{

							$q2->select('StaffMeasureID')->from('unit_measures')
								->where('StaffMeasureID', '!=', 0);
						})
			->get();



			//secondary unit targets & accomplishments
			$secondary_units = DB::table('staff_measures')
			->join('staff_targets', 'staff_measures.StaffMeasureID', '=', 'staff_targets.StaffMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->join('unit_measures', 'staff_measures.StaffMeasureID', '=', 'unit_measures.StaffMeasureID')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->join('secondary_unit_measures', 'unit_measures.UnitMeasureID', '=', 'secondary_unit_measures.UnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->where('staff_measures.StaffID', '=', $staff_id)
			->whereYear('staff_targets.TargetDate', '=', date($year))
			->whereNotIn('secondary_unit_measures.SecondaryUnitMeasureID', function($q2)
						{

							$q2->select('SecondaryUnitMeasureID')->from('tertiary_unit_measures')
								->where('SecondaryUnitMeasureID', '!=', 0);
						})
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit', 'staff_measures.StaffMeasureID as staffmeasureid' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.FebruaryAccomplishment as FebruaryStaff' , 'staff_accomplishments.MarchAccomplishment as MarchStaff' , 'staff_accomplishments.AprilAccomplishment as AprilStaff' , 'staff_accomplishments.MayAccomplishment as MayStaff' , 'staff_accomplishments.JuneAccomplishment as JuneStaff' , 'staff_accomplishments.JulyAccomplishment as JulyStaff' , 'staff_accomplishments.AugustAccomplishment as AugustStaff' , 'staff_accomplishments.SeptemberAccomplishment as SeptemberStaff' , 'staff_accomplishments.OctoberAccomplishment as OctoberStaff' , 'staff_accomplishments.NovemberAccomplishment as NovemberStaff', 'staff_accomplishments.DecemberAccomplishment as DecemberStaff', 'staff_targets.JanuaryTarget as Januarytarget' , 'staff_targets.FebruaryTarget as Februarytarget' , 'staff_targets.MarchTarget as Marchtarget' , 'staff_targets.AprilTarget as Apriltarget' , 'staff_targets.MayTarget as Maytarget' , 'staff_targets.JuneTarget as Junetarget' , 'staff_targets.JulyTarget as Julytarget' , 'staff_targets.AugustTarget as Augusttarget' , 'staff_targets.SeptemberTarget as Septembertarget' , 'staff_targets.OctoberTarget as Octobertarget' , 'staff_targets.NovemberTarget as Novembertarget' , 'staff_targets.DecemberTarget as Decembertarget', 'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondary', 'secondary_unit_accomplishments.FebruaryAccomplishment as FebruarySecondary', 'secondary_unit_accomplishments.MarchAccomplishment as MarchSecondary', 'secondary_unit_accomplishments.AprilAccomplishment as AprilSecondary', 'secondary_unit_accomplishments.MayAccomplishment as MaySecondary', 'secondary_unit_accomplishments.JuneAccomplishment as JuneSecondary', 'secondary_unit_accomplishments.JulyAccomplishment as JulySecondary', 'secondary_unit_accomplishments.AugustAccomplishment as AugustSecondary', 'secondary_unit_accomplishments.SeptemberAccomplishment as SeptemberSecondary', 'secondary_unit_accomplishments.OctoberAccomplishment as OctoberSecondary', 'secondary_unit_accomplishments.NovemberAccomplishment as NovemberSecondary', 'secondary_unit_accomplishments.DecemberAccomplishment as DecemberSecondary')
			->get();






			//tertiary unit targets & accomplishments
			$tertiary_units = DB::table('staff_measures')
			->join('staff_targets', 'staff_measures.StaffMeasureID', '=', 'staff_targets.StaffMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->join('unit_measures', 'staff_measures.StaffMeasureID', '=', 'unit_measures.StaffMeasureID')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->join('secondary_unit_measures', 'unit_measures.UnitMeasureID', '=', 'secondary_unit_measures.UnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->join('tertiary_unit_measures', 'secondary_unit_measures.SecondaryUnitMeasureID' , '=', 'tertiary_unit_measures.SecondaryUnitMeasureID')
			->join('tertiary_unit_accomplishments', 'tertiary_unit_measures.TertiaryUnitMeasureID', '=', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID')
			->where('staff_measures.StaffID', '=', $staff_id)
			->whereYear('staff_targets.TargetDate', '=', date($year))
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit', 'staff_measures.StaffMeasureID as staffmeasureid' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.FebruaryAccomplishment as FebruaryStaff' , 'staff_accomplishments.MarchAccomplishment as MarchStaff' , 'staff_accomplishments.AprilAccomplishment as AprilStaff' , 'staff_accomplishments.MayAccomplishment as MayStaff' , 'staff_accomplishments.JuneAccomplishment as JuneStaff' , 'staff_accomplishments.JulyAccomplishment as JulyStaff' , 'staff_accomplishments.AugustAccomplishment as AugustStaff' , 'staff_accomplishments.SeptemberAccomplishment as SeptemberStaff' , 'staff_accomplishments.OctoberAccomplishment as OctoberStaff' , 'staff_accomplishments.NovemberAccomplishment as NovemberStaff', 'staff_accomplishments.DecemberAccomplishment as DecemberStaff', 'staff_targets.JanuaryTarget as Januarytarget' , 'staff_targets.FebruaryTarget as Februarytarget' , 'staff_targets.MarchTarget as Marchtarget' , 'staff_targets.AprilTarget as Apriltarget' , 'staff_targets.MayTarget as Maytarget' , 'staff_targets.JuneTarget as Junetarget' , 'staff_targets.JulyTarget as Julytarget' , 'staff_targets.AugustTarget as Augusttarget' , 'staff_targets.SeptemberTarget as Septembertarget' , 'staff_targets.OctoberTarget as Octobertarget' , 'staff_targets.NovemberTarget as Novembertarget' , 'staff_targets.DecemberTarget as Decembertarget', 'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondary', 'secondary_unit_accomplishments.FebruaryAccomplishment as FebruarySecondary', 'secondary_unit_accomplishments.MarchAccomplishment as MarchSecondary', 'secondary_unit_accomplishments.AprilAccomplishment as AprilSecondary', 'secondary_unit_accomplishments.MayAccomplishment as MaySecondary', 'secondary_unit_accomplishments.JuneAccomplishment as JuneSecondary', 'secondary_unit_accomplishments.JulyAccomplishment as JulySecondary', 'secondary_unit_accomplishments.AugustAccomplishment as AugustSecondary', 'secondary_unit_accomplishments.SeptemberAccomplishment as SeptemberSecondary', 'secondary_unit_accomplishments.OctoberAccomplishment as OctoberSecondary', 'secondary_unit_accomplishments.NovemberAccomplishment as NovemberSecondary', 'secondary_unit_accomplishments.DecemberAccomplishment as DecemberSecondary' , 'tertiary_unit_accomplishments.JanuaryAccomplishment as JanuaryTertiary', 'tertiary_unit_accomplishments.FebruaryAccomplishment as FebruaryTertiary', 'tertiary_unit_accomplishments.MarchAccomplishment as MarchTertiary', 'tertiary_unit_accomplishments.AprilAccomplishment as AprilTertiary', 'tertiary_unit_accomplishments.MayAccomplishment as MayTertiary', 'tertiary_unit_accomplishments.JuneAccomplishment as JuneTertiary', 'tertiary_unit_accomplishments.JulyAccomplishment as JulyTertiary', 'tertiary_unit_accomplishments.AugustAccomplishment as AugustTertiary', 'tertiary_unit_accomplishments.SeptemberAccomplishment as SeptemberTertiary', 'tertiary_unit_accomplishments.OctoberAccomplishment as OctoberTertiary', 'tertiary_unit_accomplishments.NovemberAccomplishment as NovemberTertiary', 'tertiary_unit_accomplishments.DecemberAccomplishment as DecemberTertiary')
			->get();




			$measurecount = DB::table('staff_targets')
			->where('StaffID', '=', $staff_id)
			->whereYear('TargetDate', '=', date($year))
			->count();

			$i = 0;




			foreach($staffs as $staff)
			{

					$january[$i] = ($staff->JanuaryAccomplishment / $staff->JanuaryTarget) * 100;
					$february[$i] = ($staff->FebruaryAccomplishment / $staff->FebruaryTarget) * 100;
					$march[$i] = ($staff->MarchAccomplishment / $staff->MarchTarget) * 100;
					$april[$i] = ($staff->AprilAccomplishment / $staff->AprilTarget) * 100;
					$may[$i] = ($staff->MayAccomplishment / $staff->MayTarget) * 100;
					$june[$i] = ($staff->JuneAccomplishment / $staff->JuneTarget) * 100;
					$july[$i] = ($staff->JulyAccomplishment / $staff->JulyTarget) * 100;
					$august[$i] = ($staff->AugustAccomplishment / $staff->AugustTarget) * 100;
					$september[$i] = ($staff->SeptemberAccomplishment / $staff->SeptemberTarget) * 100;
					$october[$i] = ($staff->OctoberAccomplishment / $staff->OctoberTarget) * 100;
					$november[$i] = ($staff->NovemberAccomplishment / $staff->NovemberTarget) * 100;
					$december[$i] = ($staff->DecemberAccomplishment / $staff->DecemberTarget) * 100;
				

				$i = $i + 1;
			}


			foreach($units as $unit)
			{

					$january[$i] = (($unit->JanuaryStaff + $unit->JanuaryUnit) / $unit->Januarytarget) * 100;
					$february[$i] = (($unit->FebruaryStaff + $unit->FebruaryUnit) / $unit->Februarytarget) * 100;
					$march[$i] = (($unit->MarchStaff + $unit->MarchUnit) / $unit->Marchtarget) * 100;
					$april[$i] = (($unit->AprilStaff + $unit->AprilUnit) / $unit->Apriltarget) * 100;
					$may[$i] = (($unit->MayStaff + $unit->MayUnit) / $unit->Maytarget) * 100;
					$june[$i] = (($unit->JuneStaff + $unit->JuneUnit) / $unit->Junetarget) * 100;
					$july[$i] = (($unit->JulyStaff + $unit->JulyUnit) / $unit->Julytarget) * 100;
					$august[$i] = (($unit->AugustStaff + $unit->AugustUnit) / $unit->Augusttarget) * 100;
					$september[$i] = (($unit->SeptemberStaff + $unit->SeptemberUnit) / $unit->Septembertarget) * 100;
					$october[$i] = (($unit->OctoberStaff + $unit->OctoberUnit) / $unit->Octobertarget) * 100;
					$november[$i] = (($unit->NovemberStaff + $unit->NovemberUnit) / $unit->Novembertarget) * 100;
					$december[$i] = (($unit->DecemberStaff + $unit->DecemberUnit) / $unit->Decembertarget) * 100;
				

				$i = $i + 1; 
			}


			foreach($secondary_units as $secondary_unit)
			{

					$january[$i] = (($secondary_unit->JanuaryStaff + $secondary_unit->JanuaryUnit + $secondary_unit->JanuarySecondary) / $secondary_unit->Januarytarget) * 100;
					$february[$i] = (($secondary_unit->FebruaryStaff + $secondary_unit->FebruaryUnit + $secondary_unit->FebruarySecondary) / $secondary_unit->Februarytarget) * 100;
					$march[$i] = (($secondary_unit->MarchStaff + $secondary_unit->MarchUnit + $secondary_unit->MarchSecondary) / $secondary_unit->Marchtarget) * 100;
					$april[$i] = (($secondary_unit->AprilStaff + $secondary_unit->AprilUnit + $secondary_unit->AprilSecondary) / $secondary_unit->Apriltarget) * 100;
					$may[$i] = (($secondary_unit->MayStaff + $secondary_unit->MayUnit + $secondary_unit->MaySecondary) / $secondary_unit->Maytarget) * 100;
					$june[$i] = (($secondary_unit->JuneStaff + $secondary_unit->JuneUnit + $secondary_unit->JuneSecondary) / $secondary_unit->Junetarget) * 100;
					$july[$i] = (($secondary_unit->JulyStaff + $secondary_unit->JulyUnit + $secondary_unit->JulySecondary) / $secondary_unit->Julytarget) * 100;
					$august[$i] = (($secondary_unit->AugustStaff + $secondary_unit->AugustUnit + $secondary_unit->AugustSecondary) / $secondary_unit->Augusttarget) * 100;
					$september[$i] = (($secondary_unit->SeptemberStaff + $secondary_unit->SeptemberUnit + $secondary_unit->SeptemberSecondary) / $secondary_unit->Septembertarget) * 100;
					$october[$i] = (($secondary_unit->OctoberStaff + $secondary_unit->OctoberUnit + $secondary_unit->OctoberSecondary) / $secondary_unit->Octobertarget) * 100;
					$november[$i] = (($secondary_unit->NovemberStaff + $secondary_unit->NovemberUnit + $secondary_unit->NovemberSecondary) / $secondary_unit->Novembertarget) * 100;		
					$december[$i] = (($secondary_unit->DecemberStaff + $secondary_unit->DecemberUnit + $secondary_unit->DecemberSecondary) / $secondary_unit->Decembertarget) * 100;

				$i = $i + 1; 
			}


			foreach($tertiary_units as $tertiary_unit)
			{
				$january[$i] = (($tertiary_unit->JanuaryStaff + $tertiary_unit->JanuaryUnit + $tertiary_unit->JanuarySecondary + $tertiary_unit->JanuaryTertiary) / $tertiary_unit->Januarytarget) * 100;
				$february[$i] = (($tertiary_unit->FebruaryStaff + $tertiary_unit->FebruaryUnit + $tertiary_unit->FebruarySecondary + $tertiary_unit->FebruaryTertiary) / $tertiary_unit->Februarytarget) * 100;
				$march[$i] = (($tertiary_unit->MarchStaff + $tertiary_unit->MarchUnit + $tertiary_unit->MarchSecondary + $tertiary_unit->MarchTertiary) / $tertiary_unit->Marchtarget) * 100;
				$april[$i] = (($tertiary_unit->AprilStaff + $tertiary_unit->AprilUnit + $tertiary_unit->AprilSecondary + $tertiary_unit->AprilTertiary) / $tertiary_unit->Apriltarget) * 100;
				$may[$i] = (($tertiary_unit->MayStaff + $tertiary_unit->MayUnit + $tertiary_unit->MaySecondary + $tertiary_unit->MayTertiary) / $tertiary_unit->Maytarget) * 100;
				$june[$i] = (($tertiary_unit->JuneStaff + $tertiary_unit->JuneUnit + $tertiary_unit->JuneSecondary + $tertiary_unit->JuneTertiary) / $tertiary_unit->Junetarget) * 100;
				$july[$i] = (($tertiary_unit->JulyStaff + $tertiary_unit->JulyUnit + $tertiary_unit->JulySecondary + $tertiary_unit->JulyTertiary) / $tertiary_unit->Julytarget) * 100;
				$august[$i] = (($tertiary_unit->AugustStaff + $tertiary_unit->AugustUnit + $tertiary_unit->AugustSecondary + $tertiary_unit->AugustTertiary) / $tertiary_unit->Augusttarget) * 100;
				$september[$i] = (($tertiary_unit->SeptemberStaff + $tertiary_unit->SeptemberUnit + $tertiary_unit->SeptemberSecondary + $tertiary_unit->SeptemberTertiary) / $tertiary_unit->Septembertarget) * 100;
				$october[$i] = (($tertiary_unit->OctoberStaff + $tertiary_unit->OctoberUnit + $tertiary_unit->OctoberSecondary + $tertiary_unit->OctoberTertiary) / $tertiary_unit->Octobertarget) * 100;
				$november[$i] = (($tertiary_unit->NovemberStaff + $tertiary_unit->NovemberUnit + $tertiary_unit->NovemberSecondary + $tertiary_unit->NovemberTertiary) / $tertiary_unit->Novembertarget) * 100;		
				$december[$i] = (($tertiary_unit->DecemberStaff + $tertiary_unit->DecemberUnit + $tertiary_unit->DecemberSecondary + $tertiary_unit->DecemberTertiary) / $tertiary_unit->Decembertarget) * 100;

				$i = $i + 1; 
			}




			$firstquarter = 0;
			$secondquarter = 0;
			$thirdquarter = 0;
			$fourthquarter = 0;


			for($j = 0 ; $j < $i ; $j++)
			{
				$firstquarter = $firstquarter + (($january[$j] + $february[$j] + $march[$j]) / 3);
				$secondquarter = $secondquarter + (($april[$j] + $may[$j] + $june[$j]) / 3);
				$thirdquarter = $thirdquarter + (($july[$j] + $august[$j] + $september[$j]) / 3);
				$fourthquarter = $fourthquarter + (($october[$j] + $november[$j] + $december[$j]) / 3 );
			}



			$firstquarter = $firstquarter / $measurecount;
			$secondquarter = $secondquarter / $measurecount;
			$thirdquarter = $thirdquarter / $measurecount;
			$fourthquarter = $fourthquarter / $measurecount;
			

			$firstquarter = round($firstquarter, 2);
			$secondquarter = round($secondquarter, 2);
			$thirdquarter = round($thirdquarter, 2);
			$fourthquarter = round($fourthquarter, 2);


			$targetaccomp = array(
				  array($firstquarter),
				  array($secondquarter),
				  array($thirdquarter),
				  array($fourthquarter)
				  );
				
			

			return Response::json($targetaccomp);
		}




	public function searchstaff()
	{
		$search = $_REQUEST['search'];

		if($search != '')
		{
			$tertiaryresults = DB::table('tertiary_units')
			->where('TertiaryUnitName', 'like','%'.$search.'%')
			->orWhere('TertiaryUnitAbbreviation', 'like','%'.$search.'%')
			->get();

			$secondaryresults = DB::table('secondary_units')
			->where('SecondaryUnitName', 'like','%'.$search.'%')
			->orWhere('SecondaryUnitAbbreviation', 'like','%'.$search.'%')
			->get();

			$unitresults = DB::table('units')
			->where('UnitName', 'like','%'.$search.'%')
			->orWhere('UnitAbbreviation', 'like','%'.$search.'%')
			->get();

			$staffresults = DB::table('staffs')
			->where('StaffName', 'like', '%'.$search.'%')
			->orWhere('StaffAbbreviation', 'like','%'.$search.'%')
			->get();

			$chiefresults = DB::table('chiefs')
			->where('ChiefName', 'like', '%'.$search.'%')
			->orWhere('ChiefAbbreviation', 'like','%'.$search.'%')
			->get();
		}
		else
		{
			$tertiaryresults = null;
			$secondaryresults = null;
			$unitresults = null;
			$staffresults = null;
			$chiefresults = null;	
		}
		

		return Response::json(array("u" => $unitresults, "s" => $staffresults, "c" => $chiefresults,"su" => $secondaryresults, "tu"=> $tertiaryresults,));
		
	}
	
}
