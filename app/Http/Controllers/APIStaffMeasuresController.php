<?php namespace App\Http\Controllers;

//Laravel Models
use App\StaffMeasure;
use App\StaffObjective;
use App\ChiefMeasure;
use App\StaffTarget;
use App\Staff;
use App\UserStaff;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect,Response;

class APIStaffMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->lists('StaffID'); //Get the Unit of the staff
		return StaffMeasure::where('StaffID', '=', $staff)
			->with('staff_objective')
			->with('staff')
			->with('chief_measure')
			->with('user_staff')
			->with('user_staff.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
				->first();

			$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$chief_measures = ChiefMeasure::all();
			$staff_objectives = StaffObjective::where('StaffID','=', $staff->StaffID)->get();

			$staff_measures = StaffMeasure::with('staff')->with('chief_measure')->where('StaffID', '=', $staff_user->StaffID)->get();
			
			return view('staff-ui.staff-measures')
				->with('staff_objectives', $staff_objectives)
				->with('staff_user', $staff_user)
				->with('staff', $staff)
				->with('staff_measures', $staff_measures)
				->with('chief_measures', $chief_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}


	public function chief_measures()
	{
		return ChiefMeasure::all();
	}

	public function staff_objectives()
	{
		$staff_id = Session::get('staff_user_id', 'default');
		$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)->first();
		
		return StaffObjective::where('StaffID','=',$staff_user->StaffID)->get();
	}
	public function angularchiefmeasure($measureID)
	{
		
		
		
		$chiefmeasureformula = ChiefMeasure::where('ChiefMeasureID','=',$measureID)->first();


					


		
			
		return $chiefmeasureformula;
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


		$staff_user = UserStaff::where('UserStaffID', '=', $staff_id)->first();

		//$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';

		//DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));
		$mes = Request::input('ChiefMeasureID');
		$mescontribute = StaffMeasure::where('ChiefMeasureID','=',$mes)->where('StaffID','=',$staff_user->StaffID)->first();


		if($mescontribute == null )
		{

			$staff_measure = new StaffMeasure(Request::all());
			$staff_measure->save();

			//Get the max id after saving.
			$staff_measureid = DB::table('staff_measures')->max('StaffMeasureID');

			//Use Eloquent instead! == Inserting into Staff Targets == You forgot target period
			$staff_target = new StaffTarget;
			$staff_target->TargetPeriod = "Not Set";
			$staff_target->StaffMeasureID = $staff_measureid;
			$staff_target->StaffID = $staff;
			$staff_target->UserStaffID = $staff_id;
			$staff_target->save();

			return $staff_measure;
		}
		else if($mes == 0)
		{
			$staff_measure = new StaffMeasure(Request::all());
			$staff_measure->save();

			//Get the max id after saving.
			$staff_measureid = DB::table('staff_measures')->max('StaffMeasureID');

			//Use Eloquent instead! == Inserting into Staff Targets == You forgot target period
			$staff_target = new StaffTarget;
			$staff_target->TargetPeriod = "Not Set";
			$staff_target->StaffMeasureID = $staff_measureid;
			$staff_target->StaffID = $staff;
			$staff_target->UserStaffID = $staff_id;
			$staff_target->save();

			return $staff_measure;
		}
		else
		{
			$true = "true";
			return $true; 
		}


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
		$staff_measure= StaffMeasure::find($id);
 		return $staff_measure;
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

		$staff_measure= StaffMeasure::find($id)->with('staff_objective')->with('chief_measure')->with('chief_measure.chief_objective')->with('chief_measure.chief_objective.chief')->first();

		$staff_id = Session::get('staff_user_id', 'default');
		$staff = Request::input('StaffID');

		$new_measurename = Request::input('StaffMeasureName');
		$new_measuretype = Request::input('StaffMeasureType');
		$new_measureformula = Request::input('StaffMeasureFormula');



		$action = 'Made an Update to the Measure: "' . $staff_measure->StaffMeasureName . '" under "' . $staff_measure->staff_objective->StaffObjectiveName;

		if($staff_measure->ChiefMeasureID > 0)
		{
			$action .= ' and is contributory to Chief\'s Measure: '.$staff_measure->chief_measure->ChiefMeasureName.' ';
		}

		$action .= ' with the following: ';

		if($new_measurename != $staff_measure->StaffMeasureName)
		{
			$action .= 'Measure name "'.$staff_measure->StaffMeasureName.'" to "'.$new_measurename.'", ';
		}

		if($new_measuretype != $staff_measure->StaffMeasureType)
		{
			$action .= 'Measure type "'.$staff_measure->StaffMeasureType.'" to "'.$new_measuretype.'", ';
		}

		if($new_measureformula != $staff_measure->StaffMeasureFormula)
		{
			$action .= 'Measure Formula "'.$staff_measure->StaffMeasureFormula.'" to "'.$new_measureformula.'", ';
		}

		if(Request::input('ChiefMeasureID') > 0 && Request::input('ChiefMeasureID') != $staff_measure->ChiefMeasureID)
		{
			$new_chiefmeasure = ChiefMeasure::where('ChiefMeasureID', '=', Request::input('ChiefMeasureID'))->first();
			$action .= 'Chief Measure Name to "'.$new_chiefmeasure->ChiefMeasureName.'", ';
		}

		if(Request::input('StaffObjectiveID') != $staff_measure->StaffObjectiveID)
		{
			$new_objective = StaffObjective::where('StaffObjectiveID', '=', Request::input('StaffObjectiveID'))->first();
			$action .= 'Staff\'s Objective "'.$staff_measure->staff_objective->StaffObjectiveName.'" to "'.$new_objective->StaffObjectiveName.'"';
		}

		DB::insert('insert into staff_audit_trails (Action, UserStaffID, StaffID) values (?,?,?)', array($action, $staff_id, $staff));
		


		$staff_measure = StaffMeasure::find($id);
		$staff_measure->update(Request::all());
		$staff_measure->save();
 
		
	//	$action = 'Updated a measure: "' . Request::input('UnitMeasureName') . '"';

	//	DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));



		return $staff_measure;



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
