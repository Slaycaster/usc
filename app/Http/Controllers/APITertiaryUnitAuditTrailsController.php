<?php namespace App\Http\Controllers;

use App\Perspective;
use App\UserTertiaryUnit;
use App\TertiaryAuditTrail;
use App\TertiaryUnit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APITertiaryUnitAuditTrailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tertiary_unit_id = Session::get('tertiary_user_id', 'default');
		$tertiary_unit = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_unit_id)
			->select('TertiaryUnitID')
			->lists('TertiaryUnitID'); //Get the Unit of the user
        
        $data = TertiaryAuditTrail::where('TertiaryUnitID', '=', $tertiary_unit)
            ->with('user_tertiary')
            ->with('user_tertiary.rank')
            ->get();

       	return json_encode($data, JSON_PRETTY_PRINT);
	}



	public function showIndex()
	{
		if (Session::has('tertiary_user_id'))
        {
			$id = Session::get('tertiary_user_id', 'default');
	        $user = UserTertiaryUnit::where('UserTertiaryUnitID', $id)
	        	->with('tertiary_unit')
	            ->first();

	        //$audit_trails = TertiaryAuditTrail::where('UserTertiaryUnitID', '=', $user->TertiaryUnitID)->get();
	        
	        return view('tertiary-ui.tertiary_unit-audit_trails')
	            ->with('user', $user);
	            //->with('chief_audit_trails', $chief_audit_trails);
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
