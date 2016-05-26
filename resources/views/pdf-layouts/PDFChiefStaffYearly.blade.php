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

    $staff_id = Session::get('staff_id', 'default');

      
    $staff = Staff::where('StaffID', '=', $staff_id)->first();
    $staff_objectives = StaffObjective::all();
    $staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_id)->get();
    
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

<head>
    <title>Report | PNP</title>
    <style type="text/css">
    table
    {
    	font-size: 10;
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
    	left: 70px;
    	top: 5px;
	}
    .label 
    {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 60%;
        font-family: helvetica;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    .label-default 
    {
        background-color: #777;
    }
    .labelc
    {
        display: inline;
        font-size: 60%;
        font-family: helvetica;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    .label-primary 
    {
        background-color: #337ab7;
    }
	.unitlogo
	{
    	position: absolute;
    	left: 960px;
    	top: 17px;
	}
    </style>
</head>

<body>
	<img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 122px;">
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
        	<thead style="font-weight: bold;font-family: arial,helvetica;">
                <tr>
                    <td width="53" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="68" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td width="65" rowspan="2" style="text-align: left;padding-left: 3px;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="70" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="33">Jan</td>
                    <td width="33">Feb</td>
                    <td width="33">Mar</td>
                    <td width="33">Apr</td>
                    <td width="33">May</td>
                    <td width="33">Jun</td>
                    <td width="33">Jul</td>
                    <td width="33">Aug</td>
                    <td width="33">Sep</td>
                    <td width="33">Oct</td>
                    <td width="33">Nov</td>
                    <td width="33">Dec</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>   
            </thead>
        	<tbody>
        		@foreach($accomplishments as $accomplishment)
        		<tr style="font-family: arial;">
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->staff_measure->staff_objective->StaffObjectiveName }}
        			</td>
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->staff_measure->StaffMeasureName }}
                        <br>
                        @if($accomplishment->staff_measure->StaffMeasureID > 0)
                            <span class="labelc label-primary">Contributory to C, PNP</span>
                        @endif
                        <div style="font-size: 9px;font-style: italic;">Contributory/ies to this Measure</div>
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div style="font-size: 9px;">
                                    <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			@if($accomplishment->staff_measure->StaffMeasureType == 'LG')
                        <td style="background-color: #5cb85c;"></td>
                        <td></td>
                    @else
                        <td></td>
                        <td style="background-color: #5cb85c;"></td>
                    @endif
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->staff_owner->StaffOwnerContent }}
        			</td>
        			<td>
        				{{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->JanuaryAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->JanuaryAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->FebruaryAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->FebruaryAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
    				</td>
        			<td>
        				{{ round($accomplishment->MarchTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->MarchAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->MarchAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->AprilTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->AprilAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->AprilAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->MayTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->MayAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->MayAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->JuneTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->JuneAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->JuneAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->JulyTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->JulyAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->JulyAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->AugustTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->AugustAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->AugustAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->SeptemberAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->SeptemberAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->OctoberAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->OctoberAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->NovemberAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->NovemberAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b><br>{{ round($accomplishment->staff_accomplishment->DecemberAccomplishment, 2) }}
                        @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                            @foreach($contributor->unit_accomplishments as $contributory)
                                <div>
                                    <b>+{{ round($contributory->DecemberAccomplishment, 2) }}</b> <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
                                </div>
                            @endforeach
                        @endforeach
        			</td>
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->staff_initiative->StaffInitiativeContent }}
        			</td>
        			<td style="text-align: right;">
        				{{ round($accomplishment->staff_funding->StaffFundingEstimate, 2) }}
        			</td>
        			<td style="text-align: right;">
        				{{ round($accomplishment->staff_funding->StaffFundingActual, 2) }}
        			</td>
        			<td style="text-align: right;">
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