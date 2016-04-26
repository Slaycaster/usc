<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect, Session;
use Illuminate\Http\Request;
use App\UserUnit;
use App\Unit;
use App\UnitObjective;
use App\Perspective;

class UnitObjectivesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('unit_user_id'))
		{
			$perspectives = Perspective::all();
			$id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', $id)
				->first();
			$unit = Unit::where('UnitID', '=', $user)->get();
			$unit_objectives = UnitObjective::where('UnitID', '=', $user->UnitID)->get();
			
			return view('unit-ui.unit-objectives')
				->with('user', $user)
				->with('unit_objectives', $unit_objectives)
				->with('unit', $unit)

				->with('perspectives', $perspectives);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

}
