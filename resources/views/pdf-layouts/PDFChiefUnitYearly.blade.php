<?php
	
//Models
use App\UnitTarget;
use App\UnitMeasure;
use App\UnitObjective;
use App\Unit;
use App\UserUnit;
use App\UnitAccomplishment;
use App\UnitOwner;
use App\UnitInitiative;
use App\UnitFunding;

	$selectedYear = Session::get('year', 'default');	
 	$unit_id = Session::get('unit_id', 'default');

	$unit = Unit::where('UnitID', '=', $unit_id)->first();
	
    $unit_objectives = UnitObjective::all();

	$unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $unit_id)->get();
	
	$accomplishments = UnitTarget::with('unit_measure')
									->with('unit_measure.unit_objective')
									->with('unit_owner')
									->with('unit_funding')
									->with('unit_initiative')
									->with('unit_accomplishment')
									->with('user_unit')
									->with('user_unit.rank')
									->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
									->where('UnitID', '=', $unit->UnitID)
									->get();


    $user = UserUnit::where('UnitID', $unit_id)
                    ->first();

	foreach ($accomplishments as $accomplishment)
	{
		//dd($accomplishment);
	}
	//dd($accomplishments);	
	$logoPath = 'img/pnp_logo2.png';
	$unitlogoPath = 'uploads/unitpictures/cropped/'.$unit->PicturePath;
?>

<!DOCTYPE html>

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
        background-color: #d9534f;
    }
	.unitlogo
	{
    	position: absolute;
    	left: 960px;
    	top: 16px;
	}
    </style>
</head>

<body>
	<img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 125px;">
	<img class="unitlogo" src="{{URL::asset($unitlogoPath)}}" style="height: 120px;width: 120px;">
	<p style="text-align: center;">
		<normal style="font-size: 15px">Republic of the Philippines</normal>
		<br>
		<strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
		<br>
		<normal style="font-size: 15px">{{ $unit->UnitName }}</normal>
		<br>
		<normal style="font-size: 10px">usc.pulis.net</normal>
	</p>
	<p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $unit->UnitAbbreviation }} Scorecard for {{ $selectedYear }}</p>
    @if(count($accomplishments)>0)
    	<table border="1">
        	<thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td width="53" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="83" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td rowspan="2" style="text-align: left;padding-left: 3px;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="88" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="30">Jan</td>
                    <td width="30">Feb</td>
                    <td width="30">Mar</td>
                    <td width="30">Apr</td>
                    <td width="30">May</td>
                    <td width="30">Jun</td>
                    <td width="30">Jul</td>
                    <td width="30">Aug</td>
                    <td width="30">Sep</td>
                    <td width="30">Oct</td>
    				<td width="30">Nov</td>
    				<td width="30">Dec</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>	
        	</thead>
        	<tbody>
        		@foreach($accomplishments as $accomplishment)
        		<tr style="font-family: arial;">
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->unit_measure->unit_objective->UnitObjectiveName }}
        			</td>
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->unit_measure->UnitMeasureName }}
                        @if($accomplishment->unit_measure->StaffMeasureID > 0)
                            <br>
                            <span class="label label-primary">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                        @endif
        			</td>
                    @if($accomplishment->unit_measure->UnitMeasureType == 'LG')
                        <td style="background-color: #5cb85c;"></td>
                        <td></td>
                    @else
                        <td></td>
                        <td style="background-color: #5cb85c;"></td>
                    @endif
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->unit_owner->UnitOwnerContent }}
        			</td>
        			<td>
        				{{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->JanuaryAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->FebruaryAccomplishment, 2) }}
    				</td>
        			<td>
        				{{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->MarchAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->AprilAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->MayAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->JuneAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->JulyAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->AugustAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->SeptemberAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->OctoberAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->NovemberAccomplishment, 2) }}
        			</td>
        			<td>
        				{{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
        				<br>
        				{{ round($accomplishment->unit_accomplishment->DecemberAccomplishment, 2) }}
        			</td>
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->unit_initiative->UnitInitiativeContent }}
        			</td>
        			<td style="text-align: right;">
        				{{ round($accomplishment->unit_funding->UnitFundingEstimate, 2) }}
        			</td>
        			<td style="text-align: right;">
        				{{ round($accomplishment->unit_funding->UnitFundingActual, 2) }}
        			</td>
        			<td style="text-align: right;">
        				{{ round(($accomplishment->unit_funding->UnitFundingEstimate - $accomplishment->unit_funding->UnitFundingActual), 2) }}
        			</td>
        		</tr>
        		@endforeach
        	</tbody>
    	</table>
    @else
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
    <?php

        $maxid = UnitAccomplishment::where('UnitID','=',$unit->UnitID)->max('updated_at');
            $maxid2 = UnitOwner::where('UnitID','=',$unit->UnitID)->max('updated_at');
            $maxid3 = UnitInitiative::where('UnitID','=',$unit->UnitID)->max('updated_at');
            $maxid4 = UnitFunding::where('UnitID','=',$unit->UnitID)->max('updated_at');


            $updatedby = UnitAccomplishment::where('updated_at','=',$maxid)
                ->with('user_unit')
                ->with('user_unit.rank')
                ->first();

            $updatedby2 = UnitOwner::where('updated_at','=',$maxid2)
                ->with('user_unit')
                ->with('user_unit.rank')
                ->first(); 

            $updatedby3 = UnitInitiative::where('updated_at','=',$maxid3)
                ->with('user_unit')
                ->with('user_unit.rank')
                ->first();

            $updatedby4 = UnitFunding::where('updated_at','=',$maxid4)
                ->with('user_unit')
                ->with('user_unit.rank')
                ->first(); 

        //dd($updatedby);
    ?>
    <br>
    <div>
        <i>
            Accomplishment last updated by: 
            <b>{{ $updatedby->user_unit->rank->RankCode }} {{ $updatedby->user_unit->UserUnitLastName }}, {{ $updatedby->user_unit->UserUnitFirstName }} {{ date('F d, Y', strtotime($updatedby->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby->updated_at)) }}</b>
        </i>
        <br>
        <i>
            Owner last updated by:  
            <b>{{ $updatedby2->user_unit->rank->RankCode }} {{ $updatedby2->user_unit->UserUnitLastName }}, {{ $updatedby2->user_unit->UserUnitFirstName }} {{ date('F d, Y', strtotime($updatedby2->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby2->updated_at)) }}</b>
        </i>
        <br>
        <i>
            Initiative last updated by:  
            <b>{{ $updatedby3->user_unit->rank->RankCode }} {{ $updatedby3->user_unit->UserUnitLastName }}, {{ $updatedby3->user_unit->UserUnitFirstName }} {{ date('F d, Y', strtotime($updatedby3->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby3->updated_at)) }}</b>
        </i>
        <br>
        <i>
            Funding last updated by:  
            <b>{{ $updatedby4->user_unit->rank->RankCode }} {{ $updatedby4->user_unit->UserUnitLastName }}, {{ $updatedby4->user_unit->UserUnitFirstName }} {{ date('F d, Y', strtotime($updatedby4->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby4->updated_at)) }}</b>
        </i>
    </div>
</body>