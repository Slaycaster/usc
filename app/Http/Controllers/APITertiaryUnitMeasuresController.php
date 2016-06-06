<?php namespace App\Http\Controllers;

//Models
use App\TertiaryUnitObjective;
use App\TertiaryUnitMeasure;
use App\SecondaryUnitMeasure;
use App\UserTertiaryUnit;
use App\TertiaryUnit;
use App\TertiaryUnitTarget;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;


class APITertiaryUnitMeasuresController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $id)->select('TertiaryUnitID')->lists('TertiaryUnitID'); //Get the Unit of the user
        
		return TertiaryUnitMeasure::where('TertiaryUnitID', '=', $tertiary_unit)
			->with('tertiary_unit_objective')
			->with('secondary_unit_measure')
			->with('tertiary_unit')
			->with('user_tertiary_unit')
			->with('user_tertiary_unit.rank')
			->get();
	}

	public function showIndex()
	{
		if (Session::has('tertiary_user_id'))
		{
			$id = Session::get('tertiary_user_id');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->first();

			$tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->with('secondary_unit')->first();
		
			$secondary_unit_measures = SecondaryUnitMeasure::where('SecondaryUnitID','=',$tertiary_unit->SecondaryUnitID)->get();
			$tertiary_unit_objectives = TertiaryUnitObjective::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)->get();
			$tertiary_unit_measures = TertiaryUnitMeasure::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->get();
			
			return view('tertiary-ui.tertiary-measures')
				->with('user', $user)
				->with('tertiary_unit', $tertiary_unit)
				->with('secondary_unit_measures', $secondary_unit_measures)
				->with('tertiary_unit_objectives', $tertiary_unit_objectives)
				->with('tertiary_unit_measures', $tertiary_unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function secondary_unit_measures()
	{
		$id = Session::get('tertiary_user_id', 'default');
		$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->first();

		$tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->with('secondary_unit')->first();
		return SecondaryUnitMeasure::where('SecondaryUnitID','=',$tertiary_unit->SecondaryUnitID)->get();
	}

	public function tertiary_unit_objectives()
	{
		$id = Session::get('tertiary_user_id', 'default');
		$user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $id)->first();
		
		return TertiaryUnitObjective::where('TertiaryUnitID','=',$user->TertiaryUnitID)->get();
	}

	public function angularsecondaryunitmeasure($measureID)
	{
		$secondaryunitmeasureformula = SecondaryUnitMeasure::where('SecondaryUnitMeasureID','=',$measureID)->first();


					


		
			
		return $secondaryunitmeasureformula;
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


			
		$id = Session::get('tertiary_user_id', 'default');
		$user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
				->first();
		$tertiary_unit = Request::input('TertiaryUnitID');
		$action = 'Added a measure: "' . Request::input('TertiaryUnitMeasureName') . '"';


		$mes = Request::input('SecondaryUnitMeasureID');
		$mescontribute = TertiaryUnitMeasure::where('SecondaryUnitMeasureID','=',$mes)->where('TertiaryUnitID','=',$user->TertiaryUnitID)->first();


		if($mescontribute == null )
		{
			DB::insert('insert into tertiary_audit_trails (Action, UserTertiaryUnitID, TertiaryUnitID) values (?,?,?)', array($action, $id, $tertiary_unit));
			$tertiary_unit_measure = new TertiaryUnitMeasure(Request::all());
			$tertiary_unit_measure->save();

			//Get the max id after saving.
			$tertiary_unit_measureid = DB::table('tertiary_unit_measures')->max('TertiaryUnitMeasureID');

			//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
			$tertiary_unit_target = new TertiaryUnitTarget;
			$tertiary_unit_target->TargetPeriod = "Not Set";
			$tertiary_unit_target->TertiaryUnitMeasureID = $tertiary_unit_measureid;
			$tertiary_unit_target->TertiaryUnitID = $tertiary_unit;
			$tertiary_unit_target->UserTertiaryUnitID = $id;
			$tertiary_unit_target->save();

			return $tertiary_unit_measure;

		}
		else if($mes == 0)
		{
			DB::insert('insert into tertiary_audit_trails (Action, UserTertiaryUnitID, TertiaryUnitID) values (?,?,?)', array($action, $id, $tertiary_unit));
			$tertiary_unit_measure = new TertiaryUnitMeasure(Request::all());
			$tertiary_unit_measure->save();

			//Get the max id after saving.
			$tertiary_unit_measureid = DB::table('tertiary_unit_measures')->max('TertiaryUnitMeasureID');

			//Use Eloquent instead! == Inserting into Unit Targets == You forgot target period
			$tertiary_unit_target = new TertiaryUnitTarget;
			$tertiary_unit_target->TargetPeriod = "Not Set";
			$tertiary_unit_target->TertiaryUnitMeasureID = $tertiary_unit_measureid;
			$tertiary_unit_target->TertiaryUnitID = $tertiary_unit;
			$tertiary_unit_target->UserTertiaryUnitID = $id;
			$tertiary_unit_target->save();

			return $tertiary_unit_measure;
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
		$tertiary_unit_measure= TertiaryUnitMeasure::find($id);
 		return $tertiary_unit_measure;
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
		/*

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
		*/

		$tertiary_unit_measure = TertiaryUnitMeasure::find($id);
		$tertiary_unit_measure->update(Request::all());
		$tertiary_unit_measure->save();


		return $tertiary_unit_measure;



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
