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

	public function changeuserpicture()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', $chief_id)
				->with('chief')
				->first();
		

			return view('chief-ui.chief-changeuserpicture')
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



		public function donutgraph()
		{

			
			$year = $_REQUEST['year'];
			$chief_id = $_REQUEST['chief_id'];

			//staff targets & accomplishments

			$staffs = DB::table('chief_measures')
			->join('chief_targets', 'chief_measures.ChiefMeasureID', '=', 'chief_targets.ChiefMeasureID')
			->join('staff_measures', 'chief_measures.ChiefMeasureID', '=', 'staff_measures.ChiefMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->whereNotIn('staff_measures.StaffMeasureID', function($q2)
						{

							$q2->select('StaffMeasureID')->from('unit_measures')
								->where('StaffMeasureID', '!=', 0);
						})
			->get();

			$units = DB::table('chief_measures')
			->join('chief_targets', 'chief_measures.ChiefMeasureID', '=', 'chief_targets.ChiefMeasureID')
			->join('staff_measures', 'chief_measures.ChiefMeasureID', '=', 'staff_measures.ChiefMeasureID')
			->join('staff_accomplishments', 'staff_measures.StaffMeasureID', '=', 'staff_accomplishments.StaffMeasureID')
			->join('unit_measures', 'staff_measures.StaffMeasureID', '=', 'unit_measures.StaffMeasureID')
			->join('unit_accomplishments', 'unit_measures.UnitMeasureID', '=', 'unit_accomplishments.UnitMeasureID')
			->where('chief_measures.ChiefID', '=', $chief_id)
			->whereYear('TargetDate', '=', date($year))
			->select('unit_accomplishments.UnitAccomplishmentID as UnitAccomplishmentID','unit_accomplishments.JanuaryAccomplishment as JanuaryUnit', 'unit_accomplishments.FebruaryAccomplishment as FebruaryUnit', 'unit_accomplishments.MarchAccomplishment as MarchUnit', 'unit_accomplishments.AprilAccomplishment as AprilUnit', 'unit_accomplishments.MayAccomplishment as MayUnit', 'unit_accomplishments.JuneAccomplishment as JuneUnit', 'unit_accomplishments.JulyAccomplishment as JulyUnit', 'unit_accomplishments.AugustAccomplishment as AugustUnit', 'unit_accomplishments.SeptemberAccomplishment as SeptemberUnit', 'unit_accomplishments.OctoberAccomplishment as OctoberUnit', 'unit_accomplishments.NovemberAccomplishment as NovemberUnit', 'unit_accomplishments.DecemberAccomplishment as DecemberUnit', 'staff_measures.StaffMeasureID as staffmeasureid' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.JanuaryAccomplishment as JanuaryStaff' , 'staff_accomplishments.FebruaryAccomplishment as FebruaryStaff' , 'staff_accomplishments.MarchAccomplishment as MarchStaff' , 'staff_accomplishments.AprilAccomplishment as AprilStaff' , 'staff_accomplishments.MayAccomplishment as MayStaff' , 'staff_accomplishments.JuneAccomplishment as JuneStaff' , 'staff_accomplishments.JulyAccomplishment as JulyStaff' , 'staff_accomplishments.AugustAccomplishment as AugustStaff' , 'staff_accomplishments.SeptemberAccomplishment as SeptemberStaff' , 'staff_accomplishments.OctoberAccomplishment as OctoberStaff' , 'staff_accomplishments.NovemberAccomplishment as NovemberStaff', 'staff_accomplishments.DecemberAccomplishment as DecemberStaff', 'chief_targets.JanuaryTarget as Januarytarget' , 'chief_targets.FebruaryTarget as Februarytarget' , 'chief_targets.MarchTarget as Marchtarget' , 'chief_targets.AprilTarget as Apriltarget' , 'chief_targets.MayTarget as Maytarget' , 'chief_targets.JuneTarget as Junetarget' , 'chief_targets.JulyTarget as Julytarget' , 'chief_targets.AugustTarget as Augusttarget' , 'chief_targets.SeptemberTarget as Septembertarget' , 'chief_targets.OctoberTarget as Octobertarget' , 'chief_targets.NovemberTarget as Novembertarget' , 'chief_targets.DecemberTarget as Decembertarget')
			->get();



			$measurecount = DB::table('chief_measures')
			->where('ChiefID', '=', $chief_id)
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
			$fourthquarter = $firstquarter / $measurecount;
			


			$targetaccomp = array(
				  array($firstquarter),
				  array($secondquarter),
				  array($thirdquarter),
				  array($fourthquarter)
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
