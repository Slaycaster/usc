<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\StaffAuditTrail;
use App\UserStaff;
use App\Staff;
use Session, DB, Validator, Input, Redirect;

class APIStaffAuditTrailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$staff_id = Session::get('staff_user_id', 'default');
		$staff = UserStaff::where('UserStaffID', '=', $staff_id)
			->select('StaffID')
			->lists('StaffID'); //Get the Unit of the user
        
        return StaffAuditTrail::where('StaffID', '=', $staff)
            ->with('user_staff')
            ->with('user_staff.rank')
            ->get();
	}

	public function showIndex()
	{
		if (Session::has('staff_user_id'))
        {
			$id = Session::get('staff_user_id', 'default');
	        $staff_user = UserStaff::where('UserStaffID', $id)
	            ->first();
	        $staff = Staff::where('UserStaffID', '=', $staff_user)->get();
	        $staff_audit_trails = StaffAuditTrail::where('UserStaffID', '=', $staff_user->StaffID)->get();
	        
	        return view('staff-ui.staff-audit_trails')
	            ->with('staff_user', $staff_user)
	            ->with('staff', $staff)
	            ->with('staff_audit_trails', $staff_audit_trails);
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
