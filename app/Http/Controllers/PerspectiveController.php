<?php namespace App\Http\Controllers;


use App\Perspective;
use App\Http\Controllers\Controller;
use Request, Session, DB, Validator, Input, Redirect;

	
class PerspectiveController extends Controller 
{
	public function allPerspectives()
	{
		return Perspective::all();
	}
}