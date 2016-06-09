<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session;


class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('unit_user_id'))
		{
			return Redirect::to('unit/dashboard');
		}
		if (Session::has('staff_user_id'))
		{
			return Redirect::to('staff/dashboard');
		}
		if (Session::has('chief_user_id'))
		{
			return Redirect::to('chief/dashboard');
		}
		if (Session::has('secondary_user_id'))
		{
			return Redirect::to('secondary_unit/dashboard');
		}
		if (Session::has('tertiary_user_id'))
		{
			return Redirect::to('tertiary/dashboard');
		}
		else
		{
			return view('welcome');
		}
		
	}

}
