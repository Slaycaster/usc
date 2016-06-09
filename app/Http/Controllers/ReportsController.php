<?php namespace App\Http\Controllers;


//Models
use App\Unit;
use App\UserUnit;

use App\Staff;
use App\UserStaff;

use App\Chief;
use App\UserChief;

use App\SecondaryUnit;
use App\UserSecondaryUnit;

use App\TertiaryUnit;
use App\UserTertiaryUnit;


use Barryvdh\DomPDF\Facade as PDF;

//Laravel Modules
use App\Http\Controllers\Controller;
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

			for($y = date("Y"); $y >= 2011; $y--)
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

	public function tertiaryIndex()
	{
		if (Session::has('tertiary_user_id'))
		{	
			$tertiary_id = Session::get('tertiary_user_id', 'default');
			$user = UserTertiaryUnit::where('UserTertiaryUnitID', '=', $tertiary_id)
							->with('tertiary_unit')
							->first();

			$tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $user->TertiaryUnitID)->first();
			$year = array();

			for($y = date("Y"); $y >= 2011; $y--)
			{
				array_push($year, $y);
			}
			
			return view('tertiary-ui.tertiary-reports')
					->with('tertiary_unit', $tertiary_unit)
					->with('user', $user)
					->with('years', $year);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function secondaryIndex()
	{
		if (Session::has('secondary_user_id'))
		{
			$id = Session::get('secondary_user_id', 'default');
			$user = UserSecondaryUnit::where('UserSecondaryUnitID', $id)
				->with('secondary_unit')
				->first();

			$secondary_unit = secondaryunit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->first();
			$year = array();

			for($y = date("Y"); $y >= 2011; $y--)
			{
				array_push($year, $y);
			}
			
			return view('secondary-unit-ui.secondary-unit-reports')
				->with('secondary_unit', $secondary_unit)
				->with('user', $user)
				->with('years', $year);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function staffIndex()
	{
		if (Session::has('staff_user_id'))
		{
			$staff_id = Session::get('staff_user_id', 'default');
			$staff_user = UserStaff::where('UserstaffID', '=', $staff_id)
				->first();

			$staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
			$year = array();

			for($y = date("Y"); $y >= 2011; $y--)
			{
				array_push($year, $y);
			}
			
			return view('staff-ui.staff-reports')
				->with('staff_user', $staff_user)
				->with('staff', $staff)
				->with('years', $year);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function chiefIndex()
	{
		if (Session::has('chief_user_id'))
		{
			$chief_id = Session::get('chief_user_id', 'default');
			$chief_user = UserChief::where('UserChiefID', '=', $chief_id)
				->first();

			$chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
			$year = array();

			for($y = date("Y"); $y >= 2011; $y--)
			{
				array_push($year, $y);
			}
			
			return view('chief-ui.chief-reports')
					->with('chief_user', $chief_user)
					->with('chief', $chief)
					->with('years', $year);
		}
		else
		{
			Session::flash('message', 'Please login first!');
			return Redirect::to('/');
		}
	}

	public function quarterlyUnit()
	{	
		$year = Input::get('year');
		$quarter = Input::get('quarter');
		Session::put('year', $year);
		Session::put('quarter', $quarter);

		$pdf = PDF::loadView('pdf-layouts.PDFUnitQuarterlyAnalysis')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function quarterlyTertiaryUnit()
	{	
		$year = Input::get('year');
		$quarter = Input::get('quarter');
		Session::put('year', $year);
		Session::put('quarter', $quarter);

		$pdf = PDF::loadView('pdf-layouts.PDFTertiaryUnitQuarterlyAnalysis')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function quarterlyStaff()
	{	
		$year = Input::get('year');
		$quarter = Input::get('quarter');
		Session::put('year', $year);
		Session::put('quarter', $quarter);

		$pdf = PDF::loadView('pdf-layouts.PDFStaffQuarterlyAnalysis')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function quarterlyChief()
	{	
		$year = Input::get('year');
		$quarter = Input::get('quarter');
		Session::put('year', $year);
		Session::put('quarter', $quarter);

		if(Input::get('breakdown'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefQuarterly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
  	    }
		elseif(Input::get('total'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefQuarterlyTotal')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
	  	}
	  	
	}

	public function currentYearUnitScorecard()
	{	
		$year = date("Y");
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function currentYearSecondaryUnitScorecard()
	{	
		$year = date("Y");
		Session::put('year', $year);

		if(Input::get('breakdown'))
		{
			Session::put('reportType', 'breakdown');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
		}
		elseif(Input::get('total'))
		{
			Session::put('reportType', 'total');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();	
		}
	}

	public function currentYearStaffScorecard()
	{	
		$year = date("Y");
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFStaffYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function currentYearChiefScorecard()
	{	
		$year = date("Y");
		Session::put('year', $year);

  	    if(Input::get('breakdown'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
		}
		elseif(Input::get('total'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearlyTotal')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();	
		}
	}

	public function yearlyUnitScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}


	public function yearlySecondaryUnitScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);
		
  	    if(Input::get('breakdown'))
		{
			Session::put('reportType', 'breakdown');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
		}
		elseif(Input::get('total'))
		{
			Session::put('reportType', 'total');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();	
		}
		elseif(Input::get('quarterlybreakdown'))
		{
			Session::put('reportType', 'breakdown');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearlybyQuarter')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
	  	}
	  	elseif(Input::get('quarterlytotal'))
		{
			Session::put('reportType', 'total');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryUnitYearlybyQuarter')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();	
	  	}
	}
	
	public function yearlyTertiaryUnitScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFTertiaryUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function yearlyStaffScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFStaffYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function yearlyChiefScorecard()
	{	
		$year = Input::get('year');
		Session::put('year', $year);
		if(Input::get('breakdown'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearly')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
		}
		elseif(Input::get('total'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearlyTotal')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();	
		}
		elseif(Input::get('yearlybreakdown'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearlybyQuarter')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
	  	}
	  	elseif(Input::get('yearlytotal'))
		{
			$pdf = PDF::loadView('pdf-layouts.PDFChiefYearlybyQuarterTotal')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
	  	}
	}



	public function currentYearChiefUnitScorecard($id)
	{	
		$year = date("Y");
		Session::put('unit_id', $id);
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFChiefUnitYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function currentYearSearchableSecondaryUnitScorecard($id)
	{	
		$year = date("Y");
		Session::put('secondary_unit_id', $id);
		Session::put('year', $year);

			Session::put('reportType', 'breakdown');
			$pdf = PDF::loadView('pdf-layouts.PDFSecondaryCurrentYear')->setPaper('Folio')->setOrientation('Landscape');
			$pdf->output();
			$dom_pdf = $pdf->getDomPDF();
			$canvas = $dom_pdf ->get_canvas();
			$canvas->page_text(788, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
	  	    return $pdf->stream();
	}

	public function currentYearChiefStaffScorecard($id)
	{	
		$year = date("Y");
		Session::put('staff_id', $id);
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFChiefStaffYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}

	public function currentYearStaffChiefScorecard($id)
	{	
		$year = date("Y");
		Session::put('chief_id', $id);
		Session::put('year', $year);

		$pdf = PDF::loadView('pdf-layouts.PDFStaffChiefYearly')->setPaper('Folio')->setOrientation('Landscape');
		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();
		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(808, 580, "usc.pulis.net - Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  	    return $pdf->stream();
	}
} 	