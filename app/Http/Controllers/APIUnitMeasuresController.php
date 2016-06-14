<?php namespace App\Http\Controllers;

//Models
use App\UnitObjective;
use App\UnitMeasure;
use App\StaffMeasure;
use App\UserUnit;
use App\Unit;
use App\UnitTarget;
use App\Staff;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect,Response;


class APIUnitMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('unit_user_id', 'default');
		$unit = UserUnit::where('UserUnitID', '=', $id)->select('UnitID')->lists('UnitID'); //Get the Unit of the user
        
		return UnitMeasure::where('UnitID', '=', $unit)
			->with('unit_objective')
			->with('staff_measure')
			->with('unit')
			->with('user_unit')
			->with('user_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('unit_user_id'))
		{
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();

			$unit = Unit::where('UnitID', '=', $user->UnitID)->with('staff')->first();
		
			$staff_measures = StaffMeasure::where('StaffID','=',$unit->StaffID)->get();
			$unit_objectives = UnitObjective::where('UnitID','=',$unit->UnitID)->get();
			$unit_measures = UnitMeasure::where('UnitID', '=', $user->UnitID)->get();
			
			return view('unit-ui.unit-measures')
				->with('user', $user)
				->with('unit', $unit)
				->with('staff_measures', $staff_measures)
				->with('unit_objectives', $unit_objectives)
				->with('unit_measures', $unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function staff_measures()
	{

			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();

			$unit = Unit::where('UnitID', '=', $user->UnitID)->with('staff')->first();

			if($unit->StaffID == null)
			{
				$staff = StaffMeasure::with(array('staff' => function($q)
					{
						$q->where('StaffHasUnit', '=', 1);
					}))->get();
				$istrue = "true";

				$staffmeasure = array(
					"array1" => $staff,
					"array2" => $istrue
				);

				return Response::json($staffmeasure);
				//return StaffMeasure::with('Staff')->get();

			}
			else
			{
				$staff = StaffMeasure::where('StaffID','=',$unit->StaffID)->get();
				$istrue = "false";

				$staffmeasure = array(
					"array1" => $staff,
					"array2" => $istrue
				);
				return Response::json($staffmeasure);
				//return StaffMeasure::where('StaffID','=',$unit->StaffID)->get();
				
			}
			//$hascontributory = UnitMeasure::where('UnitID', '=', $user->UnitID)->select('StaffMeasureID')->lists('StaffMeasureID');

		//return StaffMeasure::where('StaffID','=',$unit->StaffID)->whereNotIn('StaffMeasureID',$hascontributory)->get();

		
	}

	public function unit_objectives()
	{
		
		$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
		return UnitObjective::where('UnitID','=',$user->UnitID)->get();
	}

	public function ifhascontributory($measureID)
	{
			$id = Session::get('unit_user_id', 'default');
		$user = UserUnit::where('UserUnitID', '=', $id)->first();
		$mescontribute = UnitMeasure::where('StaffMeasureID','=',$measureID)->where('UnitID','=',$user->UnitID)->first();

		if($mescontribute == null)
		{
			return "none";
		}
		else
		{
			return "true";
		}

	}
	public function angularstaffmeasure($measureID)
	{
		$staffmeasureformula = StaffMeasure::where('StaffMeasureID','=',$measureID)->first();


					


		
			
		return $staffmeasureformula;
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


			
		$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
		$unit = Request::input('UnitID');
		$action = 'Added a measure: "' . Request::input('UnitMeasureName') . '"';


		//$mes = Request::input('StaffMeasureID');
		//$mescontribute = UnitMeasure::where('StaffMeasureID','=',$mes)->where('UnitID','=',$user->UnitID)->first();


		// if($mescontribute == null )
		// {
			DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));
			$unit_measure = new UnitMeasure(Request::all());
			$unit_measure->save();

			//Get the max id after saving.
			$unit_measureid = DB::table('unit_measures')->max('UnitMeasureID');

			//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
			$unit_target = new UnitTarget;
			$unit_target->TargetPeriod = "Not Set";
			$unit_target->UnitMeasureID = $unit_measureid;
			$unit_target->UnitID = $unit;
			$unit_target->UserUnitID = $id;
			$unit_target->save();

			return $unit_measure;

		// }
		// else if($mes == 0)
		// {
		// 	DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $id, $unit));
		// 	$unit_measure = new UnitMeasure(Request::all());
		// 	$unit_measure->save();

		// 	//Get the max id after saving.
		// 	$unit_measureid = DB::table('unit_measures')->max('UnitMeasureID');

		// 	//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
		// 	$unit_target = new UnitTarget;
		// 	$unit_target->TargetPeriod = "Not Set";
		// 	$unit_target->UnitMeasureID = $unit_measureid;
		// 	$unit_target->UnitID = $unit;
		// 	$unit_target->UserUnitID = $id;
		// 	$unit_target->save();

		// 	return $unit_measure;
		// }
		// else
		// {
		// 	$true = "true";
		// 	return $true; 
		// }



		



		

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
		$unit_measure= UnitMeasure::find($id);
 		return $unit_measure;
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


		$unitmeasure = UnitMeasure::find($id)->with('unit_objective')->with('staff_measure')->with('staff_measure.staff_objective')->with('staff_measure.staff_objective.staff')->first();
 
		$unitid = Session::get('unit_user_id', 'default');
		$unit = Request::input('UnitID');
		

		$new_measurename = Request::input('UnitMeasureName');
		$new_measuretype = Request::input('UnitMeasureType');
		$new_measureformula = Request::input('UnitMeasureFormula');

		

		$action = 'Made an Update to the Measure: "' . $unitmeasure->UnitMeasureName . '" under "' . $unitmeasure->unit_objective->UnitObjectiveName;

		if($unitmeasure->StaffMeasureID > 0)
		{
			$action .= ' and is contributory to Staff\'s Measure: '.$unitmeasure->staff_measure->StaffMeasureName.' ';
		}


		$action .= ' with the following: ';

		if($new_measurename != $unitmeasure->UnitMeasureName)
		{
			$action .= 'Measure name "'.$unitmeasure->UnitMeasureName.'" to "'.$new_measurename.'", ';
		}


		if($new_measuretype != $unitmeasure->UnitMeasureType)
		{
			$action .= 'Measure type "'.$unitmeasure->UnitMeasureType.'" to "'.$new_measuretype.'", ';
		}

		if($new_measureformula != $unitmeasure->UnitMeasureFormula)
		{
			$action .= 'Measure Formula "'.$unitmeasure->UnitMeasureFormula.'" to "'.$new_measureformula.'", ';
		}

		if(Request::input('StaffMeasureID') > 0 && Request::input('StaffMeasureID') != $unitmeasure->StaffMeasureID)
		{
			$new_staffmeasure = StaffMeasure::where('StaffMeasureID', '=', Request::input('StaffMeasureID'))->first();
			$action .= 'Staff Measure Name to "'.$new_staffmeasure->StaffMeasureName.'", ';
		}

		if(Request::input('UnitObjectiveID') != $unitmeasure->UnitObjectiveID)
		{
			$new_objective = UnitObjective::where('UnitObjectiveID', '=', Request::input('UnitObjectiveID'))->first();
			$action .= 'Unit\'s Objective "'.$unitmeasure->unit_objective->UnitObjectiveName.'" to "'.$new_objective->UnitObjectiveName.'"';
		}


		DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $unitid, $unit));


		$unit_measure = UnitMeasure::find($id);
		$unit_measure->update(Request::all());
		$unit_measure->save();


		return $unit_measure;



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
