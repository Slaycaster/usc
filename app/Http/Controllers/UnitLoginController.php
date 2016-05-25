<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserUnit;
use App\UnitObjective;
use App\UnitMeasure;

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

			return view('unit-ui.unit-scorecard')
				->with('user', $user)
				->with('unit_measures',$unit_measures);
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


			//ACCOMPLISHMENTS
			$januaryaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberaccomp = DB::table('unit_accomplishments')
			->where('UnitID', '=', $unit_id)
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
