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
