<?php namespace App\Http\Controllers;

//MODELS
//Our Freelance Models
use App\UserChief;
use App\ChiefObjective;
use App\ChiefMeasure;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Crypt, DB, Response;

class ChiefLoginController extends Controller {

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
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
			$chief_objectives_count = ChiefObjective::where('ChiefID', $chief_user->ChiefID)
				->count();
			$chief_measures_count = ChiefMeasure::where('ChiefID', $chief_user->ChiefID)
				->count();
			return view('chiefdashboard')
				->with('chief_id', $chief_id)
				->with('chief_user', $chief_user)
				->with('chief_objectives_count', $chief_objectives_count)
				->with('chief_measures_count', $chief_measures_count)
				->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	public function scorecard()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();

			return view('chief-ui.chief-scorecard')
				->with('chief_user', $chief_user)
				->with('chief_measures',$chief_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changepass()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();

			return view('chief-ui.chief-changepassword')
				->with('chief_user', $chief_user)
				->with('chief_measures',$chief_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}


	public function changechiefpicture()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
		

			return view('chief-ui.chief-changechiefpicture')
				->with('chief_user', $chief_user);
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
			$chief_id = $_REQUEST['chief_id'];

			$january = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JanuaryTarget');

			$february = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('FebruaryTarget');

			$march = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MarchTarget');

			$april = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AprilTarget');

			$may = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MayTarget');

			$june = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JuneTarget');

			$july = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JulyTarget');

			$august = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AugustTarget');

			$september = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('SeptemberTarget');

			$october = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('OctoberTarget');

			$november = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('NovemberTarget');

			$december = DB::table('chief_targets')
			->where('ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('DecemberTarget');





			$januaryaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberaccomp = DB::table('chief_accomplishments')
			->where('ChiefID', '=', $chief_id)
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


<<<<<<< HEAD

	public function searchunit()
	{
		$search = $_REQUEST['search'];

		$searchresults = DB::table('units')
		->where('UnitName', 'like', $search.'%')
		->get();


		return Response::json($searchresults);
		
	}

=======
>>>>>>> e0fcbfa5f79cb9b75b9461da9101f8a11840984b
	
}
