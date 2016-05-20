<?php namespace App\Http\Controllers;


//Models
use App\Http\Controllers\Controller;
use App\Unit;
use App\UserUnit;
use Barryvdh\DomPDF\Facade as PDF;
use Request, Session, DB, Validator, Input, Redirect;

	
class ReportsController extends Controller 
{
	public function unitIndex()
	{
		if (Session::has('unit_user_id'))
		{	
			$unit_id = Session::get('unit_user_id', 'default');
			$user = UserUnit::where('UserUnitID', '=', $unit_id)
				->with('unit')
				->first();

			$unit = unit::where('UnitID', '=', $user->UnitID)->first();
			$year = array();

			for($y = date("Y"); $y >= 2000; $y--)
			{
				array_push($year, $y);
			}
			
			return view('unit-ui.unit-reports')
					->with('unit', $unit)
					->with('user', $user)
					->with('years', $year);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}
	public function yearlyUnitScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);

		$pdf = PDF::loadView('PDFUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
  	    return $pdf->stream();

	}
}