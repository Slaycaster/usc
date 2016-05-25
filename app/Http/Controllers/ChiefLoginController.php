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

			//CHIEF TARGETS

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





			//CONTRIBUTORIES UNITS

			$januaryunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberunit= DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberunit = DB::table('unit_accomplishments')
			->join('unit_measures', 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->join('staff_measures', 'unit_measures.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');




			//CONTRIBUTORIES STAFF
			$januarystaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarystaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maystaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junestaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julystaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$auguststaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberstaff = DB::table('staff_accomplishments')
			->join('staff_measures', 'staff_accomplishments.StaffMeasureID', '=', 'staff_measures.StaffMeasureID')
			->join('chief_measures', 'staff_measures.ChiefMeasureID', '=', 'chief_measures.ChiefMeasureID')
			->where('chief_measures.ChiefID' , '=', $chief_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');




			//UNIT + STAFF


			$januaryaccomp = $januarystaff + $januaryunit ;
			$februaryaccomp = $februarystaff + $februaryunit ;
			$marchaccomp = $marchstaff + $marchunit ;
			$aprilaccomp = $aprilstaff + $aprilunit ;
			$mayaccomp = $maystaff + $mayunit ;
			$juneaccomp = $junestaff + $juneunit ;
			$julyaccomp = $julystaff + $julyunit ;
			$augustaccomp = $auguststaff + $augustunit ;
			$septemberaccomp = $septemberstaff + $septemberunit ;
			$octoberaccomp = $octoberstaff + $octoberunit ;
			$novemberaccomp = $novemberstaff + $novemberunit ;
			$decemberaccomp = $decemberstaff + $decemberunit ;

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



		public function searchunit()
	{
		$search = $_REQUEST['search'];

		if($search != '')
		{
			$unitresults = DB::table('units')
			->where('UnitName', 'like','%'.$search.'%')
			->orWhere('UnitAbbreviation', 'like','%'.$search.'%')
			->get();

			$staffresults = DB::table('staffs')
			->where('StaffName', 'like', '%'.$search.'%')
			->orWhere('StaffAbbreviation', 'like','%'.$search.'%')
			->get();
		}
		else
		{
			$unitresults = null;
			$staffresults = null;	
		}
		

		return Response::json(array("u" => $unitresults, "s" => $staffresults));
		
	}

}
