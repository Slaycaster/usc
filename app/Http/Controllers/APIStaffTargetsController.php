<?php namespace App\Http\Controllers;

//Models
use App\StaffMeasure;
use App\StaffTarget;
use App\StaffObjective;
use App\Staff;
use App\UserStaff;
use App\StaffAccomplishment;
use App\StaffOwner;
use App\StaffFunding;
use App\StaffInitiative;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIStaffTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$staff_id = Session::get('staff_user_id', 'default');

		$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->lists('StaffID'); //Get the Unit of the staff

		$currentYear = date("Y");	

		$staff_targets = StaffTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($staff_targets != null ){
			foreach ($staff_targets as $staff_target) {
				StaffTarget::where('StaffTargetID', $staff_target->StaffTargetID)
		          ->update(['Termination' => 'Terminated']);

				$stafftarget = new StaffTarget;
				$stafftarget->TargetPeriod = "Not Set";
				$stafftarget->StaffMeasureID = $staff_target->StaffMeasureID;
				$stafftarget->StaffID = $staff_target->StaffID;
				$stafftarget->UserStaffID = $staff_target->UserStaffID;
				$stafftarget->save();
			}
		}		

		return StaffTarget::with('staff_measure')
			->with('staff_measure.staff_objective')
			->with('user_staff')
			->with('user_staff.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->where('StaffID', '=', $staff)
			->get();
		
	}

	public function showIndex()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserstaffID', '=', $staff_id)
				->first();

			$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$staff_objectives = StaffObjective::all();
			$staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();
			
			return view('staff-ui.staff-targets')
				->with('staff_objectives', $staff_objectives)
				->with('staff_user', $staff_user)
				->with('staff', $staff)
				->with('staff_measures', $staff_measures);
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
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = Request::input('StaffID');
		$action = 'Added a measure: "' . Request::input('StaffMeasureName') . '"';

		//DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
		
		$staff_target = new StaffTarget(Request::all());
		$staff_target->save();

		$staff_measureid = DB::table('staff_measures')->max('StaffMeasureID');

		//Use Eloquent instead! == Inserting into staff Targets == You forgot target period
		$staff_target = new StaffTarget;
		$staff_target->TargetPeriod = "Not Set";
		$staff_target->StaffMeasureID = $staff_measureid;
		$staff_target->StaffID = $staff;
		$staff_target->UserStaffID = $staff_id;
		$staff_target->save();
		
		return $staff_target;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$staff_target= StaffTarget::find($id);
 		return $staff_target;
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
	public function updatestafftarget($id)
	{
		$staff_id = Session::get('staff_user_id', 'default');
		$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();

		$staff_target = StaffTarget::find($id);
		$staff_target->update(Request::all());

		$staff_target->save();


		$staff_accomplishment = new StaffAccomplishment();
		$staff_accomplishment->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_accomplishment->StaffID = $staff_user->StaffID;
		$staff_accomplishment->UserStaffID = $staff_user->UserStaffID;
		$staff_accomplishment->save();

		$staff_owner = new StaffOwner();
		$staff_owner->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_owner->StaffID = $staff_user->StaffID;
		$staff_owner->UserStaffID = $staff_user->UserStaffID;
		$staff_owner->save();

		$staff_initiative = new StaffInitiative();
		$staff_initiative->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_initiative->StaffID = $staff_user->StaffID;
		$staff_initiative->UserStaffID = $staff_user->UserStaffID;
		$staff_initiative->save();

		$staff_funding = new StaffFunding();
		$staff_funding->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_funding->StaffID = $staff_user->StaffID;
		$staff_funding->UserStaffID = $staff_user->UserStaffID;
		$staff_funding->save();

 		
		$staff_target = StaffTarget::find($id);
 		$staff_target->TargetDate = date('Y-m-d');
 		$staff_target->StaffAccomplishmentID = DB::table('staff_accomplishments')->max('StaffAccomplishmentID');
 		$staff_target->StaffOwnerID = DB::table('staff_owners')->max('StaffOwnerID');
 		$staff_target->StaffInitiativeID = DB::table('staff_initiatives')->max('StaffInitiativeID');
 		$staff_target->StaffFundingID = DB::table('staff_fundings')->max('StaffFundingID');
		$staff_target->save();


 	

		return $staff_target;
	}

	public function updatestaffquarter($id)
	{

		$staff_id = Session::get('staff_user_id', 'default');
		$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();
		
		$staff_target = StaffTarget::find($id);
		$targetperiod = Request::input('TargetPeriod');
		$targetdate = date('Y-m-d');

		$quarter1 = Request::input('Quarter1');
		$quarter1 = $quarter1 / 3;
		$staff_target->JanuaryTarget = $quarter1;
		$staff_target->FebruaryTarget = $quarter1;
		$staff_target->MarchTarget = $quarter1;
		
		$quarter2 = Request::input('Quarter2');
		$quarter2 = $quarter2 / 3;
		$staff_target->AprilTarget = $quarter2;
		$staff_target->MayTarget = $quarter2;
		$staff_target->JuneTarget = $quarter2;

		$quarter3 = Request::input('Quarter3');
		$quarter3 = $quarter3 / 3;
		$staff_target->JulyTarget = $quarter3;
		$staff_target->AugustTarget = $quarter3;
		$staff_target->SeptemberTarget = $quarter3;

		$quarter4 = Request::input('Quarter4');
		$quarter4 = $quarter4 / 3;
		$staff_target->OctoberTarget = $quarter4;
		$staff_target->NovemberTarget = $quarter4;
		$staff_target->DecemberTarget = $quarter4;


		$staff_target->TargetPeriod = $targetperiod;
		$staff_target->TargetDate = $targetdate;
		$staff_target->save();
		

		$staff_accomplishment = new StaffAccomplishment();
		$staff_accomplishment->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_accomplishment->StaffID = $staff_user->StaffID;
		$staff_accomplishment->UserStaffID = $staff_user->UserStaffID;
		$staff_accomplishment->save();

		$staff_owner = new StaffOwner();
		$staff_owner->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_owner->StaffID = $staff_user->StaffID;
		$staff_owner->UserStaffID = $staff_user->UserStaffID;
		$staff_owner->save();

		$staff_initiative = new StaffInitiative();
		$staff_initiative->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_initiative->StaffID = $staff_user->StaffID;
		$staff_initiative->UserStaffID = $staff_user->UserStaffID;
		$staff_initiative->save();

		$staff_funding = new StaffFunding();
		$staff_funding->StaffMeasureID = $staff_target->StaffMeasureID;
		$staff_funding->StaffID = $staff_user->StaffID;
		$staff_funding->UserStaffID = $staff_user->UserStaffID;
		$staff_funding->save(); 	


		$staff_target = StaffTarget::find($id);
 		$staff_target->TargetDate = date('Y-m-d');
 		$staff_target->StaffAccomplishmentID = DB::table('staff_accomplishments')->max('StaffAccomplishmentID');
 		$staff_target->StaffOwnerID = DB::table('staff_owners')->max('StaffOwnerID');
 		$staff_target->StaffInitiativeID = DB::table('staff_initiatives')->max('StaffInitiativeID');
 		$staff_target->StaffFundingID = DB::table('staff_fundings')->max('StaffFundingID');
		$staff_target->save();


		return $staff_target;
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
