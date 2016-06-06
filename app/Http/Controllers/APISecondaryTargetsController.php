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

class APISecondaryTargetsController extends Controller {

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
			
		return SecondaryUnitTarget::with('secondary_unit_measure')
			->with('secondary_unit_objective.secondary_unit_objective')
			->with('user_secondary_unit')
			->with('user_secondary_unit.rank')
			->where('SecondaryUnitID', '=', $secondary_unit)
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->get();
		
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
		//
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
