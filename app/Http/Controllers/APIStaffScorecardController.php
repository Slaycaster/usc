<?php namespace App\Http\Controllers;

//Models
use App\StaffTarget;
use App\StaffMeasure;
use App\StaffObjective;
use App\Staff;
use App\UserStaff;
use App\StaffAccomplishment;
use App\StaffOwner;
use App\StaffInitiative;
use App\StaffFunding;


//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect, Response;

class APIStaffScorecardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();


		$staff_id = Session::get('staff_user_id', 'default'); //get the UserstaffID stored in session.

		$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->first(); //Get the Unit of the chief

		$currentYear = date("Y");		
		
		$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$staff_objectives = StaffObjective::all();
			$staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();
	
		return StaffTarget::with('staff_measure')
			->with('staff_measure.staff_objective')
			->with('staff_measure.unit_measures.unit_accomplishments')
			->with('staff_measure.unit_measures.unit_accomplishments.unit')
			->with('staff_measure.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
			->with('staff_measure.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
			->with('staff_owner')
			->with('staff_funding')
			->with('staff_initiative')
			->with('staff_accomplishment')
			->with('user_staff')
			->with('user_staff.rank')
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->where('StaffID', '=', $staff->StaffID)
			->get();
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
		
	}

	public function LastUpdatedBy()
	{

			$staff_id = Session::get('staff_user_id', 'default'); //get the UserstaffID stored in session.

			$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->first();
			
			//dd($staff);

			$maxid = StaffAccomplishment::where('StaffID','=',$staff->StaffID)->max('updated_at');
			$maxid2 = StaffOwner::where('StaffID','=',$staff->StaffID)->max('updated_at');
			$maxid3 = StaffInitiative::where('StaffID','=',$staff->StaffID)->max('updated_at');
			$maxid4 = StaffFunding::where('StaffID','=',$staff->StaffID)->max('updated_at');


			$updatedby = StaffAccomplishment::where('updated_at','=',$maxid)
				->with('user_staff')
				->with('user_staff.rank')
				->first();

			$updatedby2 = StaffOwner::where('updated_at','=',$maxid2)
				->with('user_staff')
				->with('user_staff.rank')
				->first(); 

			$updatedby3 = StaffInitiative::where('updated_at','=',$maxid3)
				->with('user_staff')
				->with('user_staff.rank')
				->first();

			$updatedby4 = StaffFunding::where('updated_at','=',$maxid4)
				->with('user_staff')
				->with('user_staff.rank')
				->first(); 

				$lastupdate = array(
					"updated1" => $updatedby,
					"updated2" => $updatedby2,
					"updated3" => $updatedby3,
					"updated4" => $updatedby4
				);
		

			return Response::json($lastupdate);
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
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		$staff_id = Session::get('staff_user_id', 'default');
		$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();

		$staff_target = StaffTarget::find($id);
		
		$staff_accomplishmentID = $staff_target->StaffAccomplishmentID;
		$staff_ownerID = $staff_target->StaffOwnerID;
		$staff_initiativeID = $staff_target->StaffInitiativeID;
		$staff_fundingID = $staff_target->StaffFundingID;



		if(Request::input('Accomplishmentpressed') == true)
		{
			$staff_accomplishment = StaffAccomplishment::find($staff_accomplishmentID);
			if (Request::input('JanuaryAccomplishment'))
				$staff_accomplishment->JanuaryAccomplishment = Request::input('JanuaryAccomplishment');
			else
				$staff_accomplishment->JanuaryAccomplishment = 0;	

			if(Request::input('FebruaryAccomplishment'))
				$staff_accomplishment->FebruaryAccomplishment = Request::input('FebruaryAccomplishment');
			else
				$staff_accomplishment->FebruaryAccomplishment = 0;

			if(Request::input('MarchAccomplishment'))
				$staff_accomplishment->MarchAccomplishment = Request::input('MarchAccomplishment');
			else
				$staff_accomplishment->MarchAccomplishment = 0;

			if(Request::input('AprilAccomplishment'))
				$staff_accomplishment->AprilAccomplishment = Request::input('AprilAccomplishment');
			else
				$staff_accomplishment->AprilAccomplishment = 0;

			if(Request::input('MayAccomplishment'))
				$staff_accomplishment->MayAccomplishment = Request::input('MayAccomplishment');
			else
				$staff_accomplishment->MayAccomplishment = 0;

			if(Request::input('JuneAccomplishment'))
				$staff_accomplishment->JuneAccomplishment = Request::input('JuneAccomplishment');
			else
				$staff_accomplishment->JuneAccomplishment = 0;

			if(Request::input('JulyAccomplishment'))
				$staff_accomplishment->JulyAccomplishment = Request::input('JulyAccomplishment');
			else
				$staff_accomplishment->JulyAccomplishment = 0;

			if(Request::input('AugustAccomplishment'))
				$staff_accomplishment->AugustAccomplishment = Request::input('AugustAccomplishment');
			else
				$staff_accomplishment->AugustAccomplishment = 0;

			if(Request::input('SeptemberAccomplishment'))
				$staff_accomplishment->SeptemberAccomplishment = Request::input('SeptemberAccomplishment');
			else
				$staff_accomplishment->SeptemberAccomplishment = 0;
			
			if(Request::input('OctoberAccomplishment'))
				$staff_accomplishment->OctoberAccomplishment = Request::input('OctoberAccomplishment');
			else
				$staff_accomplishment->OctoberAccomplishment = 0;

			if(Request::input('NovemberAccomplishment'))
				$staff_accomplishment->NovemberAccomplishment = Request::input('NovemberAccomplishment');
			else
				$staff_accomplishment->NovemberAccomplishment = 0;

			if(Request::input('DecemberAccomplishment'))
				$staff_accomplishment->DecemberAccomplishment = Request::input('DecemberAccomplishment');
			else
				$staff_accomplishment->DecemberAccomplishment = 0;

			$staff_accomplishment->AccomplishmentDate = date('Y-m-d');
			$staff_accomplishment->StaffMeasureID = Request::input('StaffMeasureID');
			
			$staff_accomplishment->StaffID = $staff_user->StaffID;
			if($staff_accomplishment->UserStaffID != $staff_id)
			{
				$staff_accomplishment->UserStaffID = $staff_id;	
			}
			$staff_accomplishment->save();
		}
		if(Request::input('Ownerpressed') == true)
		{
			$staff_owner = StaffOwner::find($staff_ownerID);
			$staff_owner->StaffOwnerContent = Request::input('StaffOwnerContent');
			$staff_owner->StaffOwnerDate = date('Y-m-d');
			$staff_owner->StaffMeasureID = Request::input('StaffMeasureID');
			if($staff_owner->UserStaffID != $staff_id)
			{
				$staff_owner->UserStaffID = $staff_id;	
			}
			$staff_owner->save();
		}
		if(Request::input('Initiativepressed') == true)
		{

			$staff_initiative = StaffInitiative::find($staff_initiativeID);
			$staff_initiative->StaffInitiativeContent = Request::input('StaffInitiativeContent');
			$staff_initiative->StaffInitiativeDate = date('Y-m-d');
			$staff_initiative->StaffMeasureID = Request::input('StaffMeasureID');
			if($staff_initiative->UserStaffID != $staff_id)
			{
				$staff_initiative->UserStaffID = $staff_id;	
			}
			$staff_initiative->save();
		}

		if(Request::input('Fundingpressed') == true)
		{

			$staff_funding = StaffFunding::find($staff_fundingID);
			$staff_funding->StaffFundingEstimate = Request::input('StaffFundingEstimate');
			$staff_funding->StaffFundingActual = Request::input('StaffFundingActual');
			$staff_funding->StaffFundingDate = date('Y-m-d');
			$staff_funding->StaffMeasureID = Request::input('StaffMeasureID');
			if($staff_funding->UserStaffID != $staff_id)
			{
				$staff_funding->UserStaffID = $staff_id;	
			}
			$staff_funding->save();
		}
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
