<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserSecondaryUnit;
use App\SecondaryUnitObjective;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class SecondaryUnitLoginController extends Controller {

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
		if (Session::has('secondary_user_id'))
		{
			$id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $id)
				->with('secondary_unit')
				->first();
			
			$secondary_unit_objectives_count = SecondaryUnitObjective::where('SecondaryUnitID', '=', $user->SecondaryUnitID)
				->count();
			$secondary_unit_measures_count = SecondaryUnitMeasure::where('SecondaryUnitID', '=', $user->SeconadryUnitID)
				->count();
			return view('secondaryunitdashboard')
				->with('secondary_unit_id', $user->SecondaryUnitID)
				->with('user', $user)
				->with('secondary_unit_objectives_count', $secondary_unit_objectives_count)
				->with('secondary_unit_measures_count', $secondary_unit_measures_count)
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
		if (Session::has('secondary_user_id'))
		{

			$secondary_user_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->with('secondary_unit')
				->first();
			$secondary_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();

			return view('secondary-unit-ui.secondary-unit-scorecard')
				->with('user', $user)
				->with('secondary_measures',$secondary_measures);

			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->first();//dd($user);
			$secondary_unit_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();
			$maxid = SecondaryUnitAccomplishment::max('updated_at');
		
			$updatedby = SecondaryUnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_unit')
				->first();
			//dd($updatedby);
			return view('secondary-unit-ui.secondary-unit-scorecard')
				->with('user', $user)
				->with('secondary_unit_measures',$secondary_unit_measures)
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
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
						->with('secondary_unit')
						->with('secondary_unit.unit')
						->first();
			$secondary_unit_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $user->SecondaryUnitID)->get();

			return view('secondary-unit-ui.secondary-unit-changepassword')
				->with('user', $user)
				->with('secondary_unit_measures',$secondary_unit_measures);

		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}


	public function changesecondaryunitpicture()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->with('secondary_unit.unit')
				->first();//dd($user);
			
			return view('secondary-unit-ui.secondary-unit-changeunitpicture')
				->with('user', $user);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function changeuserpicture()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_unit_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
				->with('secondary_unit')
				->with('secondary_unit.unit')
				->first();
			
			return view('secondary-unit-ui.secondary-unit-changeuserpicture')
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
			$secondary_unit_id = $_REQUEST['secondary_unit_id'];


			//TARGETS
			$january = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JanuaryTarget');

			$february = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('FebruaryTarget');

			$march = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MarchTarget');

			$april = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AprilTarget');

			$may = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MayTarget');

			$june = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JuneTarget');

			$july = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JulyTarget');

			$august = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AugustTarget');

			$september = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('SeptemberTarget');

			$october = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('OctoberTarget');

			$november = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('NovemberTarget');

			$december = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('DecemberTarget');


			//ACCOMPLISHMENTS
			$januaryaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberaccomp = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
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
			$secondary_unit_id = $_REQUEST['secondary_unit_id'];


			$scorecards = DB::table('secondary_unit_accomplishments')
			->join('secondary_unit_targets', 'secondary_unit_accomplishments.SecondaryUnitAccomplishmentID', '=', 'secondary_unit_targets.SecondaryUnitAccomplishmentID')
			->join('secondary_unit_measures' , 'secondary_unit_accomplishments.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.UnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->get();

			$measurecount = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
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

	
}
