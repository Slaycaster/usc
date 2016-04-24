<?php namespace App\Http\Controllers;

use App\AuditTrail;
use App\UserUnit;
use App\Unit;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;



class APIUnitAuditTrailsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $id = Session::get('unit_user_id', 'default');
        $unit = UserUnit::where('UserUnitID', '=', $id)->select('UnitID')->lists('UnitID'); //Get the Unit of the user
        
        return AuditTrail::where('UnitID', '=', $unit)
            ->with('user_unit')
            ->with('user_unit.rank')
            ->get();
    }

    public function showIndex()
    {
        if (Session::has('unit_user_id'))
        {
            $id = Session::get('unit_user_id', 'default');
            $user = UserUnit::where('UserUnitID', $id)
                ->first();
            $unit = Unit::where('UnitID', '=', $user)->get();
            $unit_audit_trails = AuditTrail::where('UserUnitID', '=', $user->UnitID)->get();
            
            return view('unit-ui.unit-audit_trails')
                ->with('user', $user)
                ->with('unit', $unit)
                ->with('unit_audit_trails', $unit_audit_trails);
        }
        else
        {
            Session::flash('message', 'Please login first!');
            return Redirect::to('/');
        }
    }

    public function api()
    {
        if (Session::has('unit_user_id'))
        {
            $id = Session::get('unit_user_id', 'default');
            $user = UserUnit::where('UserUnitID', $id)
                ->first();
            $unit = Unit::where('UnitID', '=', $user)->get();
            $unit_audit_trails = AuditTrail::where('UserUnitID', '=', $user->UnitID)->get();
            
            return view('unit-ui.unit-audit_trails_api')
                ->with('user', $user)
                ->with('unit', $unit)
                ->with('unit_audit_trails', $unit_audit_trails);
        }
        else
        {
            Session::flash('message', 'Please login first!');
            return Redirect::to('/');
        }
    }

}
