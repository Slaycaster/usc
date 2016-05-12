<?php namespace App\Http\Controllers;

use App\Perspective;
use App\ChiefObjective;
use App\Staff;
use App\Chief;
use App\UserChief;
use App\ChiefAuditTrail;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIChiefAuditTrailsDashController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$chief_id = Session::get('chief_user_id', 'default');
		$chief = UserChief::where('UserChiefID', '=', $chief_id)
			->select('ChiefID')
			->lists('ChiefID'); //Get the Unit of the user
        
        $data = ChiefAuditTrail::where('ChiefID', '=', $chief)
            ->with('user_chief')
            ->with('user_chief.rank')
            ->get();

       	return json_encode($data, JSON_PRETTY_PRINT);
	}

	public function showIndex()
	{
		if (Session::has('chief_user_id'))
        {
			$id = Session::get('chief_user_id', 'default');
	        $chief_user = UserChief::where('UserChiefID', $id)
	            ->first();
	        $chef = Chief::where('UserChiefID', '=', $chief_user)->get();
	        $chief_audit_trails = ChiefAuditTrail::where('UserChiefID', '=', $chief_user->ChiefID)->get();
	        
	        return view('chiefdashboard')
	            ->with('chief_user', $chief_user)
	            ->with('chief', $chief)
	            ->with('chief_audit_trails', $chief_audit_trails);
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
