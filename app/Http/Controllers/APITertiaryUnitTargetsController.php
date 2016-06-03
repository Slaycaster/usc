<?php namespace App\Http\Controllers;


//Models
use App\TertiaryUnitMeasure;
use App\TertiaryUnitTarget;
use App\TertiaryUnitObjective;
use App\TertiaryUnit;
use App\UserTertiaryUnit;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnitOwner;
use App\TertiaryUnitInitiative;
use App\TertiaryUnitFunding;

//Laravel Modules
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APITertiaryUnitTargetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');

		$tertiaryunit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)->select('TertiaryUnitID')->lists('TertiaryUnitID'); //Get the Unit of the unit

		$currentYear = date("Y");
		
		$tertiary_unit_targets = TertiaryUnitTarget::where( DB::raw('YEAR(TargetDate)'), '<', $currentYear )
		->where('TargetDate','!=','0000-00-00')
		->where('Termination', '=', null)
		->get();

		if($tertiary_unit_targets != null ){
			foreach ($tertiary_unit_targets as $tertiary_unit_target) {
				TertiaryUnitTarget::where('TertiaryUnitTargetID', $tertiary_unit_target->TertiaryUnitTargetID)
		          ->update(['Termination' => 'Terminated']);

				$tertiaryunittarget = new UnitTarget;
				$tertiaryunittarget->TargetPeriod = "Not Set";
				$tertiaryunittarget->TertiaryUnitMeasureID = $tertiary_unit_target->TertiaryUnitMeasureID;
				$tertiaryunittarget->TertiaryUnitID = $tertiary_unit_target->TertiaryUnitID;
				$tertiaryunittarget->UserTertiaryUnitID = $tertiary_unit_target->UserTertiaryUnitID;
				$tertiaryunittarget->save();
			}
		}	
			
		return TertiaryUnitTarget::with('tertiary_unit_measure')
			->with('tertiary_unit_measure.tertiary_unit_objective')
			->with('user_tertiary_unit')
			->with('user_tertiary_unit.rank')
			->where('TertiaryUnitID', '=', $tertiaryunit)
			->whereBetween('TargetDate', array($currentYear.'-01-01', $currentYear.'-12-31'))
			->orWhere('TargetDate', '=', '0000-00-00')
			->get();
		
	}

	public function showIndex()
	{
		if (Session::has('tertiary_user_id'))
		{	
			$tertiary_unit_id = Session::get('tertiary_user_id', 'default');

			$tertiary_user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
				->with('tertiary_unit')
				->first();
			
			$tertiaryunit = TertiaryUnit::where('TertiaryUnitID', '=', $tertiary_user->TertiaryUnitID)->first();
			$tertiary_unit_objectives = TertiaryUnitObjective::all();
			$tertiary_unit_measures = TertiaryUnitMeasure::with('tertiary_unit')->where('TertiaryUnitID', '=', $tertiary_user->TertiaryUnitID)->get();
			
			return view('tertiary-ui.tertiary-targets')
				->with('tertiary_unit_objectives', $tertiary_unit_objectives)
				->with('tertiaryunit', $tertiaryunit)
				->with('tertiary_user', $tertiary_user)
				->with('tertiary_unit_measures', $tertiary_unit_measures);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
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
