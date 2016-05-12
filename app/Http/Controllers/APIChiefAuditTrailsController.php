<?php namespace App\Http\Controllers;

use App\Perspective;
use App\ChiefObjective;
use App\Staff;
use App\Chief;
use App\UserChief;
use App\ChiefAuditTrail;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class APIChiefAuditTrailsController extends Controller {

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
	        	->with('chief')
	            ->first();
	        $chief_audit_trails = ChiefAuditTrail::where('UserChiefID', '=', $chief_user->ChiefID)->get();
	        
	        return view('chief-ui.chief-audit_trails')
	            ->with('chief_user', $chief_user)
	            ->with('chief_audit_trails', $chief_audit_trails);
	    }
        else
        {
            Session::flash('message', 'Please login first!');
            return Redirect::to('/');
        }
	}

}
