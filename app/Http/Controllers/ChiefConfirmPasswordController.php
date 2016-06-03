<?php namespace App\Http\Controllers;


use App\UserChief;
	


use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

class ChiefConfirmPasswordController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function confirmPassword()
	{
		$chief_id = Session::get('chief_user_id', 'default');

		$chief_password = Request::input('getPassword');

		$chief = UserChief::where('UserChiefID','=',$chief_id)
			->whereRaw("BINARY `UserChiefPassword`= ?",array($chief_password))
			->first();


		if($chief != null)
		{	
			$credentials = UserChief::where('UserChiefIsActive', 1)
				->where('UserChiefID', '=', $chief_id)
				->where('UserChiefPassword', '=', $chief_password)
				->first();
			
			 if (count($credentials) > 0) 
			 {
			 	return "TRUE";
			 }

		}
		return "FALSE";
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
