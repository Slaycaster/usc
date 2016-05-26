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




		public function donutgraph()
		{

			
			$year = $_REQUEST['year'];
			$unit_id = $_REQUEST['unit_id'];


			$scorecards = DB::table('unit_accomplishments')
			->join('unit_targets', 'unit_accomplishments.UnitAccomplishmentID', '=', 'unit_targets.UnitAccomplishmentID')
			->join('unit_measures' , 'unit_accomplishments.UnitMeasureID', '=', 'unit_measures.UnitMeasureID')
			->where('unit_measures.UnitID', '=', $unit_id)
			->whereYear('TargetDate', '=', date($year))
			->get();

			$measurecount = DB::table('unit_measures')
			->where('UnitID', '=', $unit_id)
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
