<?php namespace App\Http\Controllers;

//Models
use App\ChiefMeasure;
use App\ChiefAccomplishment;
use App\ChiefOwner;
use App\ChiefFunding;
use App\ChiefInitiative;
use App\ChiefTarget;
use App\ChiefObjective;
use App\Chief;
use App\UserChief;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIChiefTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$chief_id = Session::get('chief_user_id', 'default');

		$chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief

		$currentYear = date("Y");	

		$chief_targets = ChiefTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($chief_targets != null ){
			foreach ($chief_targets as $chief_target) {
				ChiefTarget::where('ChiefTargetID', $chief_target->ChiefTargetID)
		          ->update(['Termination' => 'Terminated']);

				$chieftarget = new ChiefTarget;
				$chieftarget->TargetPeriod = "Not Set";
				$chieftarget->ChiefMeasureID = $chief_target->ChiefMeasureID;
				$chieftarget->ChiefID = $chief_target->ChiefID;
				$chieftarget->UserChiefID = $chief_target->UserChiefID;
				$chieftarget->save();
			}
		}		

		return ChiefTarget::with('chief_measure')
			->with('chief_measure.chief_objective')
			->with('user_chief')
			->with('user_chief.rank')
			->where('ChiefID', '=', $chief)
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->get();
		
	}

	public function showIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();

			$chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
			$chief_objectives = ChiefObjective::all();
			$chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();
			
			return view('chief-ui.chief-targets')
				->with('chief_objectives', $chief_objectives)
				->with('chief_user', $chief_user)
				->with('chief', $chief)
				->with('chief_measures', $chief_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$chief_target = new ChiefTarget(Request::all());
		$chief_target->save();

		
		return $chief_target;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$chief_target= ChiefTarget::find($id);
 		return $chief_target;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatetarget($id)
	{

		$chief_id = Session::get('chief_user_id', 'default');
		$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();

		$chief_target = ChiefTarget::find($id);
		$chief_target->update(Request::all());
		$chief_target->save();


		$chief_accomplishment = new ChiefAccomplishment();
		$chief_accomplishment->ChiefID = $chief_user->ChiefID;
		$chief_accomplishment->UserChiefID = $chief_user->UserChiefID;
		$chief_accomplishment->save();

		$chief_owner = new ChiefOwner();
		$chief_owner->ChiefID = $chief_user->ChiefID;
		$chief_owner->UserChiefID = $chief_user->UserChiefID;
		$chief_owner->save();

		$chief_initiative = new ChiefInitiative();
		$chief_initiative->ChiefID = $chief_user->ChiefID;
		$chief_initiative->UserChiefID = $chief_user->UserChiefID;
		$chief_initiative->save();

		$chief_funding = new ChiefFunding();
		$chief_funding->ChiefID = $chief_user->ChiefID;
		$chief_funding->UserChiefID = $chief_user->UserChiefID;
		$chief_funding->save();


		$chief_target = ChiefTarget::find($id);
 		$chief_target->TargetDate = date('Y-m-d');
 		$chief_target->ChiefAccomplishmentID = DB::table('chief_accomplishments')->max('ChiefAccomplishmentID');
 		$chief_target->ChiefOwnerID = DB::table('chief_owners')->max('ChiefOwnerID');
 		$chief_target->ChiefInitiativeID = DB::table('chief_initiatives')->max('ChiefInitiativeID');
 		$chief_target->ChiefFundingID = DB::table('chief_fundings')->max('ChiefFundingID');
		$chief_target->save();
 	

		return $chief_target;
	}

	public function updatequarter($id)
	{

		$chief_id = Session::get('chief_user_id', 'default');
		$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();

		$chief_target = ChiefTarget::find($id);
		$targetperiod = Request::input('TargetPeriod');
		$targetdate =  date('Y-m-d');

		$quarter1 = Request::input('Quarter1');
		$quarter1 = $quarter1 / 3;
		$chief_target->JanuaryTarget = $quarter1;
		$chief_target->FebruaryTarget = $quarter1;
		$chief_target->MarchTarget = $quarter1;
		
		$quarter2 = Request::input('Quarter2');
		$quarter2 = $quarter2 / 3;
		$chief_target->AprilTarget = $quarter2;
		$chief_target->MayTarget = $quarter2;
		$chief_target->JuneTarget = $quarter2;

		$quarter3 = Request::input('Quarter3');
		$quarter3 = $quarter3 / 3;
		$chief_target->JulyTarget = $quarter3;
		$chief_target->AugustTarget = $quarter3;
		$chief_target->SeptemberTarget = $quarter3;

		$quarter4 = Request::input('Quarter4');
		$quarter4 = $quarter4 / 3;
		$chief_target->OctoberTarget = $quarter4;
		$chief_target->NovemberTarget = $quarter4;
		$chief_target->DecemberTarget = $quarter4;


		$chief_target->TargetPeriod = $targetperiod;
		$chief_target->TargetDate = $targetdate;
		$chief_target->save();


		
		$chief_accomplishment = new ChiefAccomplishment();
		$chief_accomplishment->ChiefID = $chief_user->ChiefID;
		$chief_accomplishment->UserChiefID = $chief_user->UserChiefID;
		$chief_accomplishment->save();

		$chief_owner = new ChiefOwner();
		$chief_owner->ChiefID = $chief_user->ChiefID;
		$chief_owner->UserChiefID = $chief_user->UserChiefID;
		$chief_owner->save();

		$chief_initiative = new ChiefInitiative();
		$chief_initiative->ChiefID = $chief_user->ChiefID;
		$chief_initiative->UserChiefID = $chief_user->UserChiefID;
		$chief_initiative->save();

		$chief_funding = new ChiefFunding();
		$chief_funding->ChiefID = $chief_user->ChiefID;
		$chief_funding->UserChiefID = $chief_user->UserChiefID;
		$chief_funding->save();

		
		$chief_target = ChiefTarget::find($id);
 		$chief_target->TargetDate = date('Y-m-d');
 		$chief_target->ChiefAccomplishmentID = DB::table('chief_accomplishments')->max('ChiefAccomplishmentID');
 		$chief_target->ChiefOwnerID = DB::table('chief_owners')->max('ChiefOwnerID');
 		$chief_target->ChiefInitiativeID = DB::table('chief_initiatives')->max('ChiefInitiativeID');
 		$chief_target->ChiefFundingID = DB::table('chief_fundings')->max('ChiefFundingID');
		$chief_target->save();

 	

		return $chief_target;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
