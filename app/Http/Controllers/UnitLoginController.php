<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserUnit;
use App\UnitObjective;
use App\UnitMeasure;
use App\UnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class UnitLoginController extends Controller {

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
		if (Session::has('unit_user_id'))
		{
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->with('unit')
				->first();
			
			$unit_objectives_count = UnitObjective::where('UnitID', '=', $user->UnitID)
				->count();
			$unit_measures_count = UnitMeasure::where('UnitID', '=', $user->UnitID)
				->count();
			return view('unitdashboard')
				->with('unit_id', $user->UnitID)
				->with('user', $user)
				->with('unit_objectives_count', $unit_objectives_count)
				->with('unit_measures_count', $unit_measures_count)
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
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $user->UnitID)->get();
			$maxid = UnitAccomplishment::max('updated_at');
		
			$updatedby = UnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_unit')
				->first();
			//dd($updatedby);
			return view('unit-ui.unit-scorecard')
				->with('user', $user)
				->with('unit_measures',$unit_measures)
				->with('updatedby',$updatedby);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changepass()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $user->UnitID)->get();

			return view('unit-ui.unit-changepassword')
				->with('user', $user)
				->with('unit_measures',$unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changeunitpicture()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			
			return view('unit-ui.unit-changeunitpicture')
				->with('user', $user);
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
			$unit_id = $_REQUEST['unit_id'];


			//TARGETS
			$january = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JanuaryTarget');

			$february = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('FebruaryTarget');

			$march = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MarchTarget');

			$april = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AprilTarget');

			$may = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MayTarget');

			$june = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JuneTarget');

			$july = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JulyTarget');

			$august = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AugustTarget');

			$september = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('SeptemberTarget');

			$october = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('OctoberTarget');

			$november = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('NovemberTarget');

			$december = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('DecemberTarget');


			//UNIT ACCOMPLISHMENTS
			$januaryunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberunit = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');


						//Secondary Unit CONTRIBUTORIES
			$januarysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junesecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julysecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustsecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octobersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decembersecondary = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_measures', 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');





			//Tertiary Unit CONTRIBUTORIES
			$januarytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchtertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$apriltertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junetertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julytertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augusttertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octobertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decembertertiary = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->join('unit_measures', 'secondary_unit_measures.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->where('unit_measures.UnitID' , '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//STAFF ACCOMP PLUS CONTRIBUTORIES

			$januaryaccomp =   $januaryunit + $januarysecondary + $januarytertiary;
			$februaryaccomp =   $februaryunit + $februarysecondary + $februarytertiary;
			$marchaccomp =   $marchunit + $marchsecondary + $marchtertiary;
			$aprilaccomp =   $aprilunit + $aprilsecondary + $apriltertiary;
			$mayaccomp =   $mayunit + $maysecondary + $maytertiary;
			$juneaccomp =   $juneunit + $junesecondary + $junetertiary;
			$julyaccomp =   $julyunit + $julysecondary + $julytertiary;
			$augustaccomp =   $augustunit + $augustsecondary + $augusttertiary;
			$septemberaccomp =   $septemberunit + $septembersecondary + $septembertertiary;
			$octoberaccomp =   $octoberunit + $octobersecondary + $octobertertiary;
			$novemberaccomp =   $novemberunit + $novembersecondary + $novembertertiary;
			$decemberaccomp =   $decemberunit + $decembersecondary + $decembertertiary;



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
			$unit_id = $_REQUEST['unit_id'];


			$scorecards = DB::table('unit_accomplishments')
			->join('unit_targets', 'unit_accomplishments.UnitAccomplishmentID', '=', 'unit_targets.UnitAccomplishmentID')
			->join('unit_measures' , 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->where('unit_measures.UnitID', '=', $unit_id)
			->whereNotIn('unit_measures.UnitMeasureID', function($q2)
						{

							$q2->select('UnitMeasureID')->from('secondary_unit_measures')
								->where('UnitMeasureID', '!=', 0);
						})
			->whereYear('TargetDate', '=', date($year))
			->get();




			//secondary unit targets & accomplishments
			$secondary_units = DB::table('unit_measures')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->join('unit_targets', 'unit_measures.UnitMeasureID', '=', 'unit_targets.UnitMeasureID')
			->join('secondary_unit_measures', 'unit_measures.UnitMeasureID', '=', 'secondary_unit_measures.UnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->where('unit_measures.UnitID', '=', $unit_id)
			->whereYear('unit_targets.TargetDate', '=', date($year))
			->whereNotIn('secondary_unit_measures.SecondaryUnitMeasureID', function($q2)
						{

							$q2->select('SecondaryUnitMeasureID')->from('tertiary_unit_measures')
								->where('SecondaryUnitMeasureID', '!=', 0);
						})
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit' ,'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondary', 'secondary_unit_accomplishments.FebruaryAccomplishment as FebruarySecondary', 'secondary_unit_accomplishments.MarchAccomplishment as MarchSecondary', 'secondary_unit_accomplishments.AprilAccomplishment as AprilSecondary', 'secondary_unit_accomplishments.MayAccomplishment as MaySecondary', 'secondary_unit_accomplishments.JuneAccomplishment as JuneSecondary', 'secondary_unit_accomplishments.JulyAccomplishment as JulySecondary', 'secondary_unit_accomplishments.AugustAccomplishment as AugustSecondary', 'secondary_unit_accomplishments.SeptemberAccomplishment as SeptemberSecondary', 'secondary_unit_accomplishments.OctoberAccomplishment as OctoberSecondary', 'secondary_unit_accomplishments.NovemberAccomplishment as NovemberSecondary', 'secondary_unit_accomplishments.DecemberAccomplishment as DecemberSecondary', 'unit_targets.JanuaryTarget as JanuaryTarget' , 'unit_targets.FebruaryTarget as FebruaryTarget' , 'unit_targets.MarchTarget as MarchTarget' , 'unit_targets.AprilTarget as AprilTarget' , 'unit_targets.MayTarget as MayTarget' , 'unit_targets.JuneTarget as JuneTarget' , 'unit_targets.JulyTarget as JulyTarget' , 'unit_targets.AugustTarget as AugustTarget' , 'unit_targets.SeptemberTarget as SeptemberTarget' , 'unit_targets.OctoberTarget as OctoberTarget' , 'unit_targets.NovemberTarget as NovemberTarget' , 'unit_targets.DecemberTarget as DecemberTarget')
			->get();



			//tertiary unit targets & accomplishments
			$tertiary_units = DB::table('unit_measures')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->join('unit_targets', 'unit_measures.UnitMeasureID', '=', 'unit_targets.UnitMeasureID')
			->join('secondary_unit_measures', 'unit_measures.UnitMeasureID', '=', 'secondary_unit_measures.UnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->join('tertiary_unit_measures', 'secondary_unit_measures.SecondaryUnitMeasureID' , '=', 'tertiary_unit_measures.SecondaryUnitMeasureID')
			->join('tertiary_unit_accomplishments', 'tertiary_unit_measures.TertiaryUnitMeasureID', '=', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID')
			->where('unit_measures.UnitID', '=', $unit_id)
			->whereYear('unit_targets.TargetDate', '=', date($year))
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit', 'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondary', 'secondary_unit_accomplishments.FebruaryAccomplishment as FebruarySecondary', 'secondary_unit_accomplishments.MarchAccomplishment as MarchSecondary', 'secondary_unit_accomplishments.AprilAccomplishment as AprilSecondary', 'secondary_unit_accomplishments.MayAccomplishment as MaySecondary', 'secondary_unit_accomplishments.JuneAccomplishment as JuneSecondary', 'secondary_unit_accomplishments.JulyAccomplishment as JulySecondary', 'secondary_unit_accomplishments.AugustAccomplishment as AugustSecondary', 'secondary_unit_accomplishments.SeptemberAccomplishment as SeptemberSecondary', 'secondary_unit_accomplishments.OctoberAccomplishment as OctoberSecondary', 'secondary_unit_accomplishments.NovemberAccomplishment as NovemberSecondary', 'secondary_unit_accomplishments.DecemberAccomplishment as DecemberSecondary' , 'tertiary_unit_accomplishments.JanuaryAccomplishment as JanuaryTertiary', 'tertiary_unit_accomplishments.FebruaryAccomplishment as FebruaryTertiary', 'tertiary_unit_accomplishments.MarchAccomplishment as MarchTertiary', 'tertiary_unit_accomplishments.AprilAccomplishment as AprilTertiary', 'tertiary_unit_accomplishments.MayAccomplishment as MayTertiary', 'tertiary_unit_accomplishments.JuneAccomplishment as JuneTertiary', 'tertiary_unit_accomplishments.JulyAccomplishment as JulyTertiary', 'tertiary_unit_accomplishments.AugustAccomplishment as AugustTertiary', 'tertiary_unit_accomplishments.SeptemberAccomplishment as SeptemberTertiary', 'tertiary_unit_accomplishments.OctoberAccomplishment as OctoberTertiary', 'tertiary_unit_accomplishments.NovemberAccomplishment as NovemberTertiary', 'tertiary_unit_accomplishments.DecemberAccomplishment as DecemberTertiary' , 'unit_targets.JanuaryTarget as JanuaryTarget' , 'unit_targets.FebruaryTarget as FebruaryTarget' , 'unit_targets.MarchTarget as MarchTarget' , 'unit_targets.AprilTarget as AprilTarget' , 'unit_targets.MayTarget as MayTarget' , 'unit_targets.JuneTarget as JuneTarget' , 'unit_targets.JulyTarget as JulyTarget' , 'unit_targets.AugustTarget as AugustTarget' , 'unit_targets.SeptemberTarget as SeptemberTarget' , 'unit_targets.OctoberTarget as OctoberTarget' , 'unit_targets.NovemberTarget as NovemberTarget' , 'unit_targets.DecemberTarget as DecemberTarget')
			->get();



			$measurecount = DB::table('unit_targets')
			->where('UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->count();

			

			$i = 0;

			foreach($scorecards as $scorecard)
			{
				$january[$i] = ($scorecard->JanuaryAccomplishment / $scorecard->JanuaryTarget) * 100;
				$february[$i] = ($scorecard->FebruaryAccomplishment / $scorecard->FebruaryTarget) * 100;
				$march[$i] = ($scorecard->MarchAccomplishment / $scorecard->MarchTarget) * 100;
				$april[$i] = ($scorecard->AprilAccomplishment / $scorecard->AprilTarget) * 100;
				$may[$i] = ($scorecard->MayAccomplishment / $scorecard->MayTarget) * 100;
				$june[$i] = ($scorecard->JuneAccomplishment / $scorecard->JuneTarget) * 100;
				$july[$i] = ($scorecard->JulyAccomplishment / $scorecard->JulyTarget) * 100;
				$august[$i] = ($scorecard->AugustAccomplishment / $scorecard->AugustTarget) * 100;
				$september[$i] = ($scorecard->SeptemberAccomplishment / $scorecard->SeptemberTarget) * 100;
				$october[$i] = ($scorecard->OctoberAccomplishment / $scorecard->OctoberTarget) * 100;
				$november[$i] = ($scorecard->NovemberAccomplishment / $scorecard->NovemberTarget) * 100;		
				$december[$i] = ($scorecard->DecemberAccomplishment / $scorecard->DecemberTarget) * 100;

				$i = $i + 1;
			}



			foreach($secondary_units as $secondary_unit)
			{
				$january[$i] = (($secondary_unit->JanuaryUnit + $secondary_unit->JanuarySecondary) / $secondary_unit->JanuaryTarget) * 100;
				$february[$i] = (($secondary_unit->FebruaryUnit + $secondary_unit->FebruarySecondary) / $secondary_unit->FebruaryTarget) * 100;
				$march[$i] = (($secondary_unit->MarchUnit + $secondary_unit->MarchSecondary) / $secondary_unit->MarchTarget) * 100;
				$april[$i] = (($secondary_unit->AprilUnit + $secondary_unit->AprilSecondary) / $secondary_unit->AprilTarget) * 100;
				$may[$i] = (($secondary_unit->MayUnit + $secondary_unit->MaySecondary) / $secondary_unit->MayTarget) * 100;
				$june[$i] = (($secondary_unit->JuneUnit + $secondary_unit->JuneSecondary) / $secondary_unit->JuneTarget) * 100;
				$july[$i] = (($secondary_unit->JulyUnit + $secondary_unit->JulySecondary) / $secondary_unit->JulyTarget) * 100;
				$august[$i] = (($secondary_unit->AugustUnit + $secondary_unit->AugustSecondary) / $secondary_unit->AugustTarget) * 100;
				$september[$i] = (($secondary_unit->SeptemberUnit + $secondary_unit->SeptemberSecondary) / $secondary_unit->SeptemberTarget) * 100;
				$october[$i] = (($secondary_unit->OctoberUnit + $secondary_unit->OctoberSecondary) / $secondary_unit->OctoberTarget) * 100;
				$november[$i] = (($secondary_unit->NovemberUnit + $secondary_unit->NovemberSecondary) / $secondary_unit->NovemberTarget) * 100;		
				$december[$i] = (($secondary_unit->DecemberUnit + $secondary_unit->DecemberSecondary) / $secondary_unit->DecemberTarget) * 100;

				$i = $i + 1;
			}






			foreach($tertiary_units as $tertiary_unit)
			{
				$january[$i] = (($tertiary_unit->JanuaryUnit + $tertiary_unit->JanuarySecondary + $tertiary_unit->JanuaryTertiary) / $tertiary_unit->JanuaryTarget) * 100;
				$february[$i] = (($tertiary_unit->FebruaryUnit + $tertiary_unit->FebruarySecondary + $tertiary_unit->FebruaryTertiary) / $tertiary_unit->FebruaryTarget) * 100;
				$march[$i] = (($tertiary_unit->MarchUnit + $tertiary_unit->MarchSecondary + $tertiary_unit->MarchTertiary) / $tertiary_unit->MarchTarget) * 100;
				$april[$i] = (($tertiary_unit->AprilUnit + $tertiary_unit->AprilSecondary + $tertiary_unit->AprilTertiary) / $tertiary_unit->AprilTarget) * 100;
				$may[$i] = (($tertiary_unit->MayUnit + $tertiary_unit->MaySecondary + $tertiary_unit->MayTertiary) / $tertiary_unit->MayTarget) * 100;
				$june[$i] = (($tertiary_unit->JuneUnit + $tertiary_unit->JuneSecondary + $tertiary_unit->JuneTertiary) / $tertiary_unit->JuneTarget) * 100;
				$july[$i] = (($tertiary_unit->JulyUnit + $tertiary_unit->JulySecondary + $tertiary_unit->JulyTertiary) / $tertiary_unit->JulyTarget) * 100;
				$august[$i] = (($tertiary_unit->AugustUnit + $tertiary_unit->AugustSecondary + $tertiary_unit->AugustTertiary) / $tertiary_unit->AugustTarget) * 100;
				$september[$i] = (($tertiary_unit->SeptemberUnit + $tertiary_unit->SeptemberSecondary + $tertiary_unit->SeptemberTertiary) / $tertiary_unit->SeptemberTarget) * 100;
				$october[$i] = (($tertiary_unit->OctoberUnit + $tertiary_unit->OctoberSecondary + $tertiary_unit->OctoberTertiary)/ $tertiary_unit->OctoberTarget) * 100;
				$november[$i] = (($tertiary_unit->NovemberUnit + $tertiary_unit->NovemberSecondary + $tertiary_unit->NovemberTertiary) / $tertiary_unit->NovemberTarget) * 100;		
				$december[$i] = (($tertiary_unit->DecemberUnit + $tertiary_unit->DecemberSecondary + $tertiary_unit->DecemberTertiary) / $tertiary_unit->DecemberTarget) * 100;

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

	public function changeuserpicture()
	{
		if (Session::has('unit_user_id'))
		{
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $unit_id)
				->with('unit')
				->with('unit.staff')
				->first();
			
			return view('unit-ui.unit-changeuserpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	
}
