<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\UserSecondaryUnit;
use App\SecondaryUnit;
use App\UnitMeasure;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitObjective;
use App\Http\Controllers\Controller;
use App\SecondaryUnitTarget;

use Request, Session, DB, Validator, Input, Redirect;

class APISecondaryUnitMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$unit = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_user_id)->select('SecondaryUnitID')->lists('SecondaryUnitID'); //Get the Unit of the user
        
		return SecondaryUnitMeasure::where('SecondaryUnitID', '=', $unit)
			->with('secondary_unit_objective')
			->with('unit_measure')
			->with('secondary_unit')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('secondary_user_id'))
		{
			$secondary_user_id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();

			$unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->with('unit')->first();
		
			//$staff_measures = StaffMeasure::where('StaffID','=',$unit->UnitID)->get();
			//$unit_objectives = UnitObjective::where('UnitID','=',$unit->UnitID)->get();
			//$unit_measures = UnitMeasure::where('UnitID', '=', $user->UnitID)->get();
			
			return view('secondary-unit-ui.secondary-unit-measures')
				->with('user', $user)
				->with('unit', $unit);
				//->with('staff_measures', $staff_measures)
				//->with('unit_objectives', $unit_objectives)
				//>with('unit_measures', $unit_measures)
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function secondaryunitobjectives()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();
		
		return SecondaryUnitObjective::where('SecondaryUnitID','=',$user->SecondaryUnitID)->get();
	}

	public function unit_measures()
	{
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();

			$unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->with('unit')->first();
		return UnitMeasure::where('UnitID','=',$unit->UnitID)->get();
	}

	public function angularunitmeasure($measureID)
	{
		$unitmeasureformula = UnitMeasure::where('UnitMeasureID','=',$measureID)->first();
		
		return $unitmeasureformula;
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
		$secondary_user_id = Session::get('secondary_user_id', 'default');
		$user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_user_id)
				->first();
		$unit = Request::input('SecondaryUnitID');
		$action = 'Added a measure: "' . Request::input('SecondaryUnitMeasureName') . '"';


		$mes = Request::input('UnitMeasureID');
		$mescontribute = SecondaryUnitMeasure::where('UnitMeasureID','=',$mes)->where('SecondaryUnitID','=',$user->SecondaryUnitID)->first();


		if($mescontribute == null )
		{
			DB::insert('insert into secondary_audit_trails (Action, UserSecondaryUnitID, SecondaryUnitID) values (?,?,?)', array($action, $secondary_user_id, $unit));
			$secondary_unit_measure = new SecondaryUnitMeasure(Request::all());
			$secondary_unit_measure->save();

			//Get the max id after saving.
			$unit_measureid = DB::table('secondary_unit_measures')->max('SecondaryUnitMeasureID');

			//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
			$unit_target = new SecondaryUnitTarget;
			$unit_target->TargetPeriod = "Not Set";
			$unit_target->SecondaryUnitMeasureID = $unit_measureid;
			$unit_target->SecondaryUnitID = $unit;
			$unit_target->UserSecondaryUnitID = $secondary_user_id;
			$unit_target->save();

			return $secondary_unit_measure;

		}
		else if($mes == 0)
		{
			DB::insert('insert into secondary_audit_trails (Action, UserSecondaryUnitID, SecondaryUnitID) values (?,?,?)', array($action, $secondary_user_id, $unit));
			$secondary_unit_measure = new SecondaryUnitMeasure(Request::all());
			$secondary_unit_measure->save();

			//Get the max id after saving.
			$unit_measureid = DB::table('secondary_unit_measures')->max('SecondaryUnitMeasureID');

			//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
			$unit_target = new SecondaryUnitTarget;
			$unit_target->TargetPeriod = "Not Set";
			$unit_target->SecondaryUnitMeasureID = $unit_measureid;
			$unit_target->SecondaryUnitID = $unit;
			$unit_target->UserSecondaryUnitID = $secondary_user_id;
			$unit_target->save();

			return $secondary_unit_measure;
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
		$unit_measure= SecondaryUnitMeasure::find($id);
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
		$unitmeasure = SecondaryUnitMeasure::find($id)->with('secondary_unit_objective')->with('unit_measure')->with('unit_measure.unit_objective')->with('unit_measure.unit_objective.unit')->first();
 
		$unitid = Session::get('secondary_user_id', 'default');
		$unit = Request::input('SecondaryUnitID');
		

		$new_measurename = Request::input('SecondaryUnitMeasureName');
		$new_measuretype = Request::input('SecondaryUnitMeasureType');
		$new_measureformula = Request::input('SecondaryUnitMeasureFormula');

		

		$action = 'Made an Update to the Measure: "' . $unitmeasure->SecondaryUnitMeasureName . '" under "' . $unitmeasure->secondary_unit_objective->SecondaryUnitObjectiveName;

		if($unitmeasure->StaffMeasureID > 0)
		{
			$action .= ' and is contributory to Unit\'s Measure: '.$unitmeasure->unit_measure->UnitMeasureName.' ';
		}


		$action .= ' with the following: ';

		if($new_measurename != $unitmeasure->SecondaryUnitMeasureName)
		{
			$action .= 'Measure name "'.$unitmeasure->SecondaryUnitMeasureName.'" to "'.$new_measurename.'", ';
		}


		if($new_measuretype != $unitmeasure->SecondaryUnitMeasureType)
		{
			$action .= 'Measure type "'.$unitmeasure->UnitMeasureType.'" to "'.$new_measuretype.'", ';
		}

		if($new_measureformula != $unitmeasure->SecondaryUnitMeasureFormula)
		{
			$action .= 'Measure Formula "'.$unitmeasure->UnitMeasureFormula.'" to "'.$new_measureformula.'", ';
		}

		if(Request::input('UnitMeasureID') > 0 && Request::input('UnitMeasureID') != $unitmeasure->UnitMeasureID)
		{
			$new_staffmeasure = UnitMeasure::where('UnitMeasureID', '=', Request::input('UnitMeasureID'))->first();
			$action .= 'Unit Measure Name to "'.$new_staffmeasure->UnitMeasureName.'", ';
		}

		if(Request::input('UnitObjectiveID') != $unitmeasure->SecondaryUnitObjectiveID)
		{
			$new_objective = SecondaryUnitObjective::where('SecondaryUnitObjectiveID', '=', Request::input('SecondaryUnitObjectiveID'))->first();
			$action .= 'Unit\'s Objective "'.$unitmeasure->secondary_unit_objective->SecondaryUnitObjectiveName.'" to "'.$new_objective->SecondaryUnitObjectiveName.'"';
		}

	
		DB::insert('insert into secondary_audit_trails (Action, UserSecondaryUnitID, SecondaryUnitID) values (?,?,?)', array($action, $unitid, $unit));


		$unit_measure = SecondaryUnitMeasure::find($id);
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
