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
			$secondary_unit_measures_count = SecondaryUnitMeasure::where('SecondaryUnitID', '=', $user->SecondaryUnitID)
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




			//CONTRIBUTORIES
			$januarytertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarytertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchtertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$apriltertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maytertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$junetertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julytertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augusttertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septembertertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octobertertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novembertertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decembertertiaryunit = DB::table('tertiary_unit_accomplishments')
			->join('tertiary_unit_measures', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID', '=', 'tertiary_unit_measures.TertiaryUnitMeasureID')
			->join('secondary_unit_measures', 'tertiary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_measures.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID' , '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//SecondaryUnit ACCOMPLISHMENTS
			$januarySecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JanuaryAccomplishment');

			$februarySecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('FebruaryAccomplishment');

			$marchSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MarchAccomplishment');

			$aprilSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AprilAccomplishment');

			$maySecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('MayAccomplishment');

			$juneSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JuneAccomplishment');

			$julySecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('JulyAccomplishment');

			$augustSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('AugustAccomplishment');

			$septemberSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('SeptemberAccomplishment');

			$octoberSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('OctoberAccomplishment');

			$novemberSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('NovemberAccomplishment');

			$decemberSecondaryUnit = DB::table('secondary_unit_accomplishments')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('AccomplishmentDate', '=', date($year))
			->sum('DecemberAccomplishment');



			//SecondaryUnit ACCOMP PLUS CONTRIBUTORIES

			$januaryaccomp = $januarySecondaryUnit + $januarytertiaryunit;
			$februaryaccomp = $februarySecondaryUnit + $februarytertiaryunit;
			$marchaccomp = $marchSecondaryUnit + $marchtertiaryunit;
			$aprilaccomp = $aprilSecondaryUnit + $apriltertiaryunit;
			$mayaccomp = $maySecondaryUnit + $maytertiaryunit;
			$juneaccomp = $juneSecondaryUnit + $junetertiaryunit;
			$julyaccomp = $julySecondaryUnit + $julytertiaryunit;
			$augustaccomp = $augustSecondaryUnit + $augusttertiaryunit;
			$septemberaccomp = $septemberSecondaryUnit + $septembertertiaryunit;
			$octoberaccomp = $octoberSecondaryUnit + $octobertertiaryunit;
			$novemberaccomp = $novemberSecondaryUnit + $novembertertiaryunit;
			$decemberaccomp = $decemberSecondaryUnit + $decembertertiaryunit;



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


			//tertiary unit targets & accomplishments
			$tertiary_units = DB::table('secondary_unit_measures')
			->join('secondary_unit_targets', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_targets.SecondaryUnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->join('tertiary_unit_measures', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'tertiary_unit_measures.SecondaryUnitMeasureID')
			->join('tertiary_unit_accomplishments', 'tertiary_unit_measures.TertiaryUnitMeasureID', '=', 'tertiary_unit_accomplishments.TertiaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->select('tertiary_unit_accomplishments.TertiaryUnitAccomplishmentID as TertiaryUnitAccomplishmentID','tertiary_unit_accomplishments.JanuaryAccomplishment as JanuaryTertiaryUnit', 'tertiary_unit_accomplishments.FebruaryAccomplishment as FebruaryTertiaryUnit', 'tertiary_unit_accomplishments.MarchAccomplishment as MarchTertiaryUnit', 'tertiary_unit_accomplishments.AprilAccomplishment as AprilTertiaryUnit', 'tertiary_unit_accomplishments.MayAccomplishment as MayTertiaryUnit', 'tertiary_unit_accomplishments.JuneAccomplishment as JuneTertiaryUnit', 'tertiary_unit_accomplishments.JulyAccomplishment as JulyTertiaryUnit', 'tertiary_unit_accomplishments.AugustAccomplishment as AugustTertiaryUnit', 'tertiary_unit_accomplishments.SeptemberAccomplishment as SeptemberTertiaryUnit', 'tertiary_unit_accomplishments.OctoberAccomplishment as OctoberTertiaryUnit', 'tertiary_unit_accomplishments.NovemberAccomplishment as NovemberTertiaryUnit', 'tertiary_unit_accomplishments.DecemberAccomplishment as DecemberTertiaryUnit', 'secondary_unit_measures.SecondaryUnitMeasureID as SecondaryUnitmeasureid' , 'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondaryUnit' , 'secondary_unit_accomplishments.JanuaryAccomplishment as JanuarySecondaryUnit' , 'secondary_unit_accomplishments.FebruaryAccomplishment as FebruarySecondaryUnit' , 'secondary_unit_accomplishments.MarchAccomplishment as MarchSecondaryUnit' , 'secondary_unit_accomplishments.AprilAccomplishment as AprilSecondaryUnit' , 'secondary_unit_accomplishments.MayAccomplishment as MaySecondaryUnit' , 'secondary_unit_accomplishments.JuneAccomplishment as JuneSecondaryUnit' , 'secondary_unit_accomplishments.JulyAccomplishment as JulySecondaryUnit' , 'secondary_unit_accomplishments.AugustAccomplishment as AugustSecondaryUnit' , 'secondary_unit_accomplishments.SeptemberAccomplishment as SeptemberSecondaryUnit' , 'secondary_unit_accomplishments.OctoberAccomplishment as OctoberSecondaryUnit' , 'secondary_unit_accomplishments.NovemberAccomplishment as NovemberSecondaryUnit', 'secondary_unit_accomplishments.DecemberAccomplishment as DecemberSecondaryUnit', 'secondary_unit_targets.JanuaryTarget as Januarytarget' , 'secondary_unit_targets.FebruaryTarget as Februarytarget' , 'secondary_unit_targets.MarchTarget as Marchtarget' , 'secondary_unit_targets.AprilTarget as Apriltarget' , 'secondary_unit_targets.MayTarget as Maytarget' , 'secondary_unit_targets.JuneTarget as Junetarget' , 'secondary_unit_targets.JulyTarget as Julytarget' , 'secondary_unit_targets.AugustTarget as Augusttarget' , 'secondary_unit_targets.SeptemberTarget as Septembertarget' , 'secondary_unit_targets.OctoberTarget as Octobertarget' , 'secondary_unit_targets.NovemberTarget as Novembertarget' , 'secondary_unit_targets.DecemberTarget as Decembertarget')
			->get();


			//SecondaryUnit targets & accomplishments
			$secondary_units = DB::table('secondary_unit_measures')
			->join('secondary_unit_targets', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_targets.SecondaryUnitMeasureID')
			->join('secondary_unit_accomplishments', 'secondary_unit_measures.SecondaryUnitMeasureID', '=', 'secondary_unit_accomplishments.SecondaryUnitMeasureID')
			->where('secondary_unit_measures.SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->whereNotIn('secondary_unit_measures.SecondaryUnitMeasureID', function($q2)
						{

							$q2->select('SecondaryUnitMeasureID')->from('tertiary_unit_measures')
								->where('SecondaryUnitMeasureID', '!=', 0);
						})
			->get();




			$measurecount = DB::table('secondary_unit_targets')
			->where('SecondaryUnitID', '=', $secondary_unit_id)
			->whereYear('TargetDate', '=', date($year))
			->count();

			$i = 0;




			foreach($secondary_units as $secondary_unit)
			{

		
				$january[$i] = ($secondary_unit->JanuaryAccomplishment / $secondary_unit->JanuaryTarget) * 100;
				$february[$i] = ($secondary_unit->FebruaryAccomplishment / $secondary_unit->FebruaryTarget) * 100;
				$march[$i] = ($secondary_unit->MarchAccomplishment / $secondary_unit->MarchTarget) * 100;
				$april[$i] = ($secondary_unit->AprilAccomplishment / $secondary_unit->AprilTarget) * 100;
				$may[$i] = ($secondary_unit->MayAccomplishment / $secondary_unit->MayTarget) * 100;
				$june[$i] = ($secondary_unit->JuneAccomplishment / $secondary_unit->JuneTarget) * 100;
				$july[$i] = ($secondary_unit->JulyAccomplishment / $secondary_unit->JulyTarget) * 100;
				$august[$i] = ($secondary_unit->AugustAccomplishment / $secondary_unit->AugustTarget) * 100;
				$september[$i] = ($secondary_unit->SeptemberAccomplishment / $secondary_unit->SeptemberTarget) * 100;
				$october[$i] = ($secondary_unit->OctoberAccomplishment / $secondary_unit->OctoberTarget) * 100;
				$november[$i] = ($secondary_unit->NovemberAccomplishment / $secondary_unit->NovemberTarget) * 100;		
				$december[$i] = ($secondary_unit->DecemberAccomplishment / $secondary_unit->DecemberTarget) * 100;


				$i = $i + 1;
			}


			foreach($tertiary_units as $tertiary_unit)
			{
				$january[$i] = (($tertiary_unit->JanuarySecondaryUnit + $tertiary_unit->JanuaryTertiaryUnit) / $tertiary_unit->Januarytarget) * 100;
				$february[$i] = (($tertiary_unit->FebruarySecondaryUnit + $tertiary_unit->FebruaryTertiaryUnit) / $tertiary_unit->Februarytarget) * 100;
				$march[$i] = (($tertiary_unit->MarchSecondaryUnit + $tertiary_unit->MarchTertiaryUnit) / $tertiary_unit->Marchtarget) * 100;
				$april[$i] = (($tertiary_unit->AprilSecondaryUnit + $tertiary_unit->AprilTertiaryUnit) / $tertiary_unit->Apriltarget) * 100;
				$may[$i] = (($tertiary_unit->MaySecondaryUnit + $tertiary_unit->MayTertiaryUnit) / $tertiary_unit->Maytarget) * 100;
				$june[$i] = (($tertiary_unit->JuneSecondaryUnit + $tertiary_unit->JuneTertiaryUnit) / $tertiary_unit->Junetarget) * 100;
				$july[$i] = (($tertiary_unit->JulySecondaryUnit + $tertiary_unit->JulyTertiaryUnit) / $tertiary_unit->Julytarget) * 100;
				$august[$i] = (($tertiary_unit->AugustSecondaryUnit + $tertiary_unit->AugustTertiaryUnit) / $tertiary_unit->Augusttarget) * 100;
				$september[$i] = (($tertiary_unit->SeptemberSecondaryUnit + $tertiary_unit->SeptemberTertiaryUnit) / $tertiary_unit->Septembertarget) * 100;
				$october[$i] = (($tertiary_unit->OctoberSecondaryUnit + $tertiary_unit->OctoberTertiaryUnit) / $tertiary_unit->Octobertarget) * 100;
				$november[$i] = (($tertiary_unit->NovemberSecondaryUnit + $tertiary_unit->NovemberTertiaryUnit) / $tertiary_unit->Novembertarget) * 100;		
				$december[$i] = (($tertiary_unit->DecemberSecondaryUnit + $tertiary_unit->DecemberTertiaryUnit) / $tertiary_unit->Decembertarget) * 100;

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

	
}
