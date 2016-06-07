<?php namespace App\Http\Controllers;

//Freelance Models
use App\UserTertiaryUnit;
use App\TertiaryUnitObjective;
use App\TertiaryUnitMeasure;
use App\TertiaryUnitAccomplishment;

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB, Crypt, Response;

class TertiaryUnitLoginController extends Controller {

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
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
			
			
			$tertiary_objectives_count = TertiaryUnitObjective::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			$tertiary_measures_count = TertiaryUnitMeasure::where('TertiaryUnitID', '=', $user->TertiaryUnitID)
				->count();
			return view('tertiaryunitdashboard')
				->with('tertiary_unit_id', $user->TertiaryUnitID)
				->with('user', $user)
				->with('tertiary_objectives_count', $tertiary_objectives_count)
				->with('tertiary_measures_count', $tertiary_measures_count)
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
		if (Session::has('tertiary_user_id'))
		{
			$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $tertiary_unit_id)
				->with('tertiary_unit')
				->with('tertiary_unit.secondary_unit')
				->first();
			
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();
			$maxid = TertiaryUnitAccomplishment::max('updated_at');
		
			$updatedby = TertiaryUnitAccomplishment::where('updated_at','=',$maxid)
				->with('user_tertiary_unit')
				->first();
			//dd($updatedby);
			return view('tertiary-ui.tertiary-scorecard')
				->with('user', $user)
				->with('tertiary_unit_measures',$tertiary_unit_measures)
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
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->with('tertiary_unit')
				->first();
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();

			return view('tertiary-ui.tertiary-changepassword')
				->with('user', $user)
				->with('tertiary_unit_measures',$tertiary_unit_measures);
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
			$tertiary_id = $_REQUEST['tertiary_unit_id'];


			//TARGETS
			$january = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JanuaryTarget');

			$february = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('FebruaryTarget');

			$march = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MarchTarget');

			$april = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AprilTarget');

			$may = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('MayTarget');

			$june = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JuneTarget');

			$july = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('JulyTarget');

			$august = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('AugustTarget');

			$september = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('SeptemberTarget');

			$october = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('OctoberTarget');

			$november = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('NovemberTarget');

			$december = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->sum('DecemberTarget');


			//ACCOMPLISHMENTS
			$januaryaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februaryaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$mayaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julyaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberaccomp = DB::table('tertiary_unit_accomplishments')
			->where('TertiaryUnitID', '=', $tertiary_id)
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
			$tertiary_id = $_REQUEST['tertiary_unit_id'];


			$scorecards = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_targets', 'tertiary_unit_accomplishments.TertiaryUnitAccomplishmentID', '=', 'tertiary_unit_targets.TertiaryUnitAccomplishmentID')
			->join('tertiary_unit_measures' , 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->where('tertiary_unit_measures.TertiaryUnitID', '=', $tertiary_id)
			->whereYear('TargetDate', '=', date($year))
			->get();

			$measurecount = DB::table('tertiary_unit_targets')
			->where('TertiaryUnitID', '=', $tertiary_id)
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
