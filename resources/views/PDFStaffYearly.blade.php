<?php
	
//Models
use App\StaffTarget;
use App\StaffMeasure;
use App\StaffObjective;
use App\Staff;
use App\UserStaff;
use App\StaffAccomplishment;
use App\StaffOwner;
use App\StaffInitiative;
use App\StaffFunding;

	$selectedYear = Session::get('year', 'default');	

    $staff_id = Session::get('staff_user_id', 'default');
    $staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
                            ->first();

    $staff_id = Session::get('staff_user_id', 'default'); //get the UserstaffID stored in session.
    $staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->first(); //Get the Unit of the chief
      
    $staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
    $staff_objectives = StaffObjective::all();
    $staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();
    
    $accomplishments = StaffTarget::with('staff_measure')
                                    ->with('staff_measure.staff_objective')
                                    ->with('staff_measure.unit_measures.unit_accomplishments')
                                    ->with('staff_measure.unit_measures.unit_accomplishments.unit')
                                    ->with('staff_owner')
                                    ->with('staff_funding')
                                    ->with('staff_initiative')
                                    ->with('staff_accomplishment')
                                    ->with('user_staff')
                                    ->with('user_staff.rank')
                                    ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->where('StaffID', '=', $staff->StaffID)
                                    ->get();

	foreach ($accomplishments as $accomplishment)
	{
		//dd($accomplishment);
	}
	//dd($accomplishments);	
	$logoPath = 'img/pnp_logo2.png';
	$stafflogoPath = 'uploads/staffpictures/cropped/'.$staff->PicturePath;
?>

<!DOCTYPE html>

<head>
    <title>Report | PNP</title>
    <style type="text/css">
    table
    {
    	font-size: 8;
    	text-align: center;
    	width: 875;
    	border-collapse: collapse;
    	page-break-inside: auto;
    }
    tr
    { 
    	page-break-inside: avoid;
    	page-break-after: auto; 
    }
    p, strong
    {
    	font-family: helvetica;
    }
    img 
    {
    	position: absolute;
    	left: 10px;
    	top: 5px;
	}
	.unitlogo
	{
    	position: absolute;
    	left: 1000px;
    	top: 20px;
	}
    </style>
</head>

<body>
	<img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 125px;">
	<img class="unitlogo" src="{{URL::asset($stafflogoPath)}}" style="height: 120px;width: 120px;">
	<p style="text-align: center;">
		<normal style="font-size: 15px">Republic of the Philippines</normal>
		<br>
		<strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
		<br>
		<normal style="font-size: 15px">{{ $staff->StaffName }}</normal>
		<br>
		<normal style="font-size: 10px">usc.pulis.net</normal>
	</p>
	<p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $staff->StaffAbbreviation }} Scorecard for {{ $selectedYear }}</p>
    @if(count($accomplishments) > 0)
    	<table border="1">
        	<thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td width="55" rowspan="2">OBJECTIVES</td>
                    <td colspan="2">MEASURES</td>
                    <td width="80" rowspan="2" >OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td rowspan="2">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="78">Name</td>
                    <td width="22">Type</td>
                    <td width="35">Jan</td>
                    <td width="35">Feb</td>
                    <td width="35">Mar</td>
                    <td width="35">Apr</td>
                    <td width="35">May</td>
                    <td width="35">Jun</td>
                    <td width="35">Jul</td>
                    <td width="35">Aug</td>
                    <td width="35">Sep</td>
                    <td width="35">Oct</td>
    				<td width="35">Nov</td>
    				<td width="35">Dec</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>	
        	</thead>
        	<tbody>
        		@foreach($accomplishments as $accomplishment)
        		<tr style="font-family: arial;">
        			<td>
        				{{ $accomplishment->staff_measure->staff_objective->StaffObjectiveName }}
        			</td>
        			<td>
        				{{ $accomplishment->staff_measure->StaffMeasureName }}
                        <br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->staff_measure->StaffMeasureType }}
        			</td>
        			<td>
        				{{ $accomplishment->staff_owner->StaffOwnerContent }}
        			</td>
        			<td>
        				{{ $accomplishment->JanuaryTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->JanuaryAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->JanuaryAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->FebruaryTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->FebruaryAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->FebruaryAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
    				</td>
        			<td>
        				{{ $accomplishment->MarchTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->MarchAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->MarchAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->AprilTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->AprilAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->AprilAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->MayTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->MayAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->MayAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->JuneTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->JuneAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->JuneAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->JulyTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->JulyAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->JulyAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->AugustTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->AugustAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->AugustAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->SeptemberTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->SeptemberAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->SeptemberAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->OctoberTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->OctoberAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->OctoberAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->NovemberTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->NovemberAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->NovemberAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->DecemberTarget }}<b>/ </b>{{ $accomplishment->staff_accomplishment->DecemberAccomplishment }}
        				<br>
                        <div style="font-size: 9px">
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <strong>+{{ $contributory->DecemberAccomplishment }}</strong> ({{ $contributory->unit->UnitAbbreviation }})
                                @endforeach
                            @endforeach
                        </div>
        			</td>
        			<td>
        				{{ $accomplishment->staff_initiative->StaffInitiativeContent }}
        			</td>
        			<td>
        				{{ $accomplishment->staff_funding->StaffFundingEstimate }}
        			</td>
        			<td>
        				{{ $accomplishment->staff_funding->StaffFundingActual }}
        			</td>
        			<td>
        				{{ round(($accomplishment->staff_funding->StaffFundingEstimate - $accomplishment->staff_funding->StaffFundingActual), 2) }}
        			</td>
        		</tr>
        		@endforeach
        	</tbody>
    	</table>
    @else
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
</body>