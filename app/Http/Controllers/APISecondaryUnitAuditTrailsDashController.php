<?php namespace App\Http\Controllers;

use App\Perspective;
use App\UserSecondaryUnit;
use App\SecondaryAuditTrail;
use App\SecondaryUnit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APISecondaryUnitAuditTrailsDashController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$secondary_unit_id = Session::get('secondary_user_id', 'default');
		$secondary_unit = UserSecondaryUnit::where('UserSecondaryUnitID', '=', $secondary_unit_id)
			->select('SecondaryUnitID')
			->lists('SecondaryUnitID'); //Get the Unit of the user
        
        $data = SecondaryAuditTrail::where('SecondaryUnitID', '=', $secondary_unit)
            ->with('user_secondary')
            ->with('user_secondary.rank')
            ->get();

       	return json_encode($data, JSON_PRETTY_PRINT);
	}

	public function showIndex()
	{
		if (Session::has('secondary_user_id'))
        {
			$id = Session::get('secondary_user_id', 'default');
	        $user = UserSecondaryUnit::where('UserSecondaryUnitID', $id)
	        	->with('secondary_unit')
	            ->first();

	        $audit_trails = SecondaryAuditTrail::where('UserSecondaryUnitID', '=', $user->SecondaryUnitID)->get();
	        
	        return view('secondaryunitdashboard')
	            ->with('user', $user)
	            ->with('audit_trails', $audit_trails);
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
