<?php namespace App\Http\Controllers;

//Models
use App\SecondaryUnitMeasure;
use App\SecondaryUnitTarget;
use App\SecondaryUnitObjective;
use App\SecondaryUnit;
use App\UserSecondaryUnit;
use App\SecondaryUnitAccomplishment;
use App\SecondaryUnitOwner;
use App\SecondaryUnitInitiative;
use App\SecondaryUnitFunding;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APISecondaryUnitTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');

		$secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $secondary_user_id)->select('UnitID')->lists('UnitID'); //Get the Unit of the unit

		$currentYear = date("Y");
		
		$secondary_unit_targets = SecondaryUnitTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($secondary_unit_targets != null ){
			foreach ($secondary_unit_targets as $secondary_unit_target) {
				SecondaryUnitTarget::where('SecondaryUnitTargetID', $secondary_unit_target->SecondaryUnitTargetID)
		          ->update(['Termination' => 'Terminated']);

				$secondaryunittarget = new SecondaryUnitTarget;
				$secondaryunittarget->TargetPeriod = "Not Set";
				$secondaryunittarget->SecondaryUnitMeasureID = $secondary_unit_target->SecondaryUnitMeasureID;
				$secondaryunittarget->SecondaryUnitID = $secondary_unit_target->SecondaryUnitID;
				$secondaryunittarget->SecondaryUserUnitID = $secondary_unit_target->SecondaryUserUnitID;
				$secondaryunittarget->save();
			}
		}	
			

		$SecondaryUnitTarget = SecondaryUnitTarget::with('secondary_unit_measure')
			->with('secondary_unit_measure.secondary_unit_objective')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->where('SecondaryUnitID', '=', $secondary_unit)
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->get();


		return json_encode($SecondaryUnitTarget, JSON_PRETTY_PRINT);
		
	}

	public function showIndex()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_user_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();
			$secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->with('unit')->first();
			// $secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $secondary_user_id)
				// ->with('unit')
				// ->first();
			
			// $secondaryunit = SecondaryUnit::where('SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)->first();
			$secondary_unit_objectives = SecondaryUnitObjective::all();
			$secondary_unit_measures = SecondaryUnitMeasure::with('secondary_unit')->where('SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)->get();
			
			$secondary_view = view('secondary-unit-ui.secondary-unit-targets')
				->with('secondary_unit_objectives', $secondary_unit_objectives)
				->with('user', $user)
				// ->with('secondaryunit', $secondaryunit)
				->with('secondary_unit', $secondary_unit)
				->with('secondary_unit_target', $secondary_unit)
				->with('secondary_unit_measures', $secondary_unit_measures);

			return $secondary_view;
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$secondary_target= SecondaryUnitTarget::find($id);
 		return $secondary_target;
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
	public function update($id)
	{
		//
	}

	public function updatetarget($id)
	{

		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();

		$secondary_unit_target = SecondaryUnitTarget::find($id);
		$secondary_unit_target->update(Request::all());
		$secondary_unit_target->save();


		$secondary_unit_accomplishment = new SecondaryUnitAccomplishment();
		$secondary_unit_accomplishment->SecondaryUnitMeasureID = $secondary_unit_target->SecondaryUnitMeasureID;
		$secondary_unit_accomplishment->SecondaryUnitID = $user->SecondaryUnitID;
		$secondary_unit_accomplishment->UserSecondaryUnitID = $user->UserSecondaryUnitID;
		$secondary_unit_accomplishment->save();

		$chief_owner = new SecondaryUnitOwner();
		$chief_owner->SecondaryUnitMeasureID = $secondary_unit_target->SecondaryUnitMeasureID;
		$chief_owner->SecondaryUnitID = $user->SecondaryUnitID;
		$chief_owner->UserSecondaryUnitID = $user->UserSecondaryUnitID;
		$chief_owner->save();

		$chief_initiative = new SecondaryUnitInitiative();
		$chief_initiative->SecondaryUnitMeasureID = $secondary_unit_target->SecondaryUnitMeasureID;
		$chief_initiative->SecondaryUnitID = $user->SecondaryUnitID;
		$chief_initiative->UserSecondaryUnitID = $user->UserSecondaryUnitID;
		$chief_initiative->save();

		$chief_funding = new SecondaryUnitFunding();
		$chief_funding->SecondaryUnitMeasureID = $secondary_unit_target->SecondaryUnitMeasureID;
		$chief_funding->SecondaryUnitID = $user->SecondaryUnitID;
		$chief_funding->UserSecondaryUnitID = $user->UserSecondaryUnitID;
		$chief_funding->save();


		$secondary_unit_target = SecondaryUnitTarget::find($id);
 		$secondary_unit_target->TargetDate = date('Y-m-d');
 		$secondary_unit_target->SecondaryUnitAccomplishmentID = DB::table('secondary_unit_accomplishments')->max('SecondaryUnitAccomplishmentID');
 		$secondary_unit_target->SecondaryUnitOwnerID = DB::table('secondary_unit_owners')->max('SecondaryUnitOwnerID');
 		$secondary_unit_target->SecondaryUnitInitiativeID = DB::table('secondary_unit_initiatives')->max('SecondaryUnitInitiativeID');
 		$secondary_unit_target->SecondaryUnitFundingID = DB::table('secondary_unit_fundings')->max('SecondaryUnitFundingID');
		$secondary_unit_target->save();
 	

		return $secondary_unit_target;
	}

	public function updatequarter($id)
	{

		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
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
		$chief_accomplishment->ChiefMeasureID = $chief_target->ChiefMeasureID;
		$chief_accomplishment->ChiefID = $chief_user->ChiefID;
		$chief_accomplishment->UserChiefID = $chief_user->UserChiefID;
		$chief_accomplishment->save();

		$chief_owner = new ChiefOwner();
		$chief_owner->ChiefMeasureID = $chief_target->ChiefMeasureID;
		$chief_owner->ChiefID = $chief_user->ChiefID;
		$chief_owner->UserChiefID = $chief_user->UserChiefID;
		$chief_owner->save();

		$chief_initiative = new ChiefInitiative();
		$chief_initiative->ChiefMeasureID = $chief_target->ChiefMeasureID;
		$chief_initiative->ChiefID = $chief_user->ChiefID;
		$chief_initiative->UserChiefID = $chief_user->UserChiefID;
		$chief_initiative->save();

		$chief_funding = new ChiefFunding();
		$chief_funding->ChiefMeasureID = $chief_target->ChiefMeasureID;
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
