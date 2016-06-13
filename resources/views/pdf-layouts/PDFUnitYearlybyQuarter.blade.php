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
use App\Rank;

use App\SecondaryUnitAccomplishment;

	$selectedYear = Session::get('year', 'default');
    $reportType = Session::get('reportType', 'default');	

 	$unit_id = Session::get('unit_user_id', 'default');
	$unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
							->first();

	$unit = Unit::where('UnitID', '=', $unit_user->UnitID)->first();
    $user = UserUnit::where('UserUnitID', $unit_id)
                    ->first();

	
	$logoPath = 'img/pnp_logo2.png';
	$unitlogoPath = 'uploads/unitpictures/cropped/'.$unit->PicturePath;
    $tempObjective = '';


    $sortByObjective = DB::table('unit_objectives')
                        ->join('unit_measures', 'unit_objectives.UnitObjectiveID', '=', 'unit_measures.UnitObjectiveID')
                        ->where('unit_objectives.UnitID', '=', $unit->UnitID)
                        ->orderBy('unit_objectives.UnitObjectiveName', 'asc')
                        ->orderBy('unit_measures.UnitMeasureID', 'asc')
                        ->get();//dd($unit->UnitID);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = UnitTarget::with('unit_measure')
                                        ->with('unit_measure.unit_objective')
                                        ->with('unit_measure.secondary_unit_measures.secondary_unit_accomplishments')
                                        ->with('unit_measure.secondary_unit_measures.secondary_unit_accomplishments.secondary_unit')
                                        ->with('unit_measure.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
                                        ->with('unit_owner')
                                        ->with('unit_funding')
                                        ->with('unit_initiative')
                                        ->with('unit_accomplishment')
                                        ->with('user_unit')
                                        ->with('user_unit.rank')
                                        ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->where('UnitID', '=', $unit->UnitID)
                                        ->where('UnitMeasureID', '=', $measure->UnitMeasureID)
                                        ->get();
        foreach ($accomplishments as $accomplishment)
        {
            //dd($accomplishment);
        }
        //dd($accomplishments);
        if(count($accomplishments) != 0)
        {
            $checkAccomplishment = $checkAccomplishment + 1;
        }
    } 
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
        color: #000;
        text-align: center;
        vertical-align: baseline;
        border-radius: .25em;
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
        vertical-align: baseline;
        border-radius: .25em;
    }
    .label-default 
    {
        background-color: #fff;
    }
    .label-gray 
    {
        background-color: #777;
    }
    .label-primary 
    {
        background-color: #5bc0de;
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
    <table border="1">
        @if($checkAccomplishment != 0)
            <thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td width="11.5%" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="73" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="4" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td width="68" rowspan="2" style="text-align: left;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="80" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="100">First Quarter</td>
                    <td width="100">Second Quarter</td>
                    <td width="100">Third Quarter</td>
                    <td width="100">Fourth Quarter</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>   
            </thead>
        @endif
        @foreach($sortByObjective as $measure)
            <?php
                $accomplishments = UnitTarget::with('unit_measure')
                                                ->with('unit_measure.unit_objective')
                                                ->with('unit_measure.secondary_unit_measures.secondary_unit_accomplishments')
                                                ->with('unit_measure.secondary_unit_measures.secondary_unit_accomplishments.secondary_unit')
                                                ->with('unit_measure.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
                                                ->with('unit_owner')
                                                ->with('unit_funding')
                                                ->with('unit_initiative')
                                                ->with('unit_accomplishment')
                                                ->with('user_unit')
                                                ->with('user_unit.rank')
                                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                                ->where('UnitID', '=', $unit->UnitID)
                                                ->where('UnitMeasureID', '=', $measure->UnitMeasureID)
                                                ->get();
                foreach ($accomplishments as $accomplishment)
                {
                    //dd($accomplishment);
                }
                //dd($accomplishments);
            ?>
            <tbody>
            	@foreach($accomplishments as $accomplishment)
            	   <tr style="font-family: arial;">
                        @if($tempObjective != $accomplishment->unit_measure->unit_objective->UnitObjectiveName)
                            <?php
                                $tempObjective = $accomplishment->unit_measure->unit_objective->UnitObjectiveName;
                            ?>
                            <td style="vertical-align: top;text-align: left;">
                                {{ $accomplishment->unit_measure->unit_objective->UnitObjectiveName }}
                            </td>
                        @else
                            <td></td>
                        @endif
            			<td style="vertical-align: top;text-align: left;">
            				{{ $accomplishment->unit_measure->UnitMeasureName }}
                            @if($accomplishment->unit_measure->StaffMeasureID > 0)
                                <br>
                                <span class="labelc label-primary">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                            @endif
                            <div style="font-size: 9px;font-style: italic;">Contributory/ies to this Measure</div>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <normal>
                                        <span class="labelc label-gray">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>
                                    </normal>
                                @endforeach
                            @endforeach
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
            			<td>{{--FIRST QUARTER--}}
            				{{ round(($accomplishment->JanuaryTarget + $accomplishment->FebruaryTarget + $accomplishment->MarchTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->unit_accomplishment->JanuaryAccomplishment + $accomplishment->unit_accomplishment->FebruaryAccomplishment + $accomplishment->unit_accomplishment->MarchAccomplishment), 2) }}
                            <?php
                                $totalFirstQuarterContribution = 0;
                                $secondary_unit_FirstQuarterchecker = null;
                                $tertiaryUnitFirstQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryFirstQuarterAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryFirstQuarterAccomplishment = $tertiaryFirstQuarterAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalFirstQuarterContribution = $contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment + $tertiaryFirstQuarterAccomplishment;
                                        $secondary_unit_FirstQuarterchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_FirstQuarterchecker != null && $totalFirstQuarterContribution != 0)
                                <b>+{{ $totalFirstQuarterContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryFirstQuarterAccomplishment = 0;
                                                $tertiaryUnitFirstQuarterCounter = $tertiaryUnitFirstQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryFirstQuarterAccomplishment = $tertiaryFirstQuarterAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitFirstQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment + $tertiaryFirstQuarterAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitFirstQuarterCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_FirstQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
            			</td>
                        <td>{{--SECOND QUARTER--}}
                            {{ round(($accomplishment->AprilTarget + $accomplishment->MayTarget + $accomplishment->JuneTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->unit_accomplishment->AprilAccomplishment + $accomplishment->unit_accomplishment->MayAccomplishment + $accomplishment->unit_accomplishment->JuneAccomplishment), 2) }}
                            <?php
                                $totalSecondQuarterContribution = 0;
                                $secondary_unit_SecondQuarterchecker = null;
                                $tertiaryUnitSecondQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiarySecondQuarterAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiarySecondQuarterAccomplishment = $tertiarySecondQuarterAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalSecondQuarterContribution = $contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment + $tertiarySecondQuarterAccomplishment;
                                        $secondary_unit_SecondQuarterchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_SecondQuarterchecker != null && $totalSecondQuarterContribution != 0)
                                <b>+{{ $totalSecondQuarterContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiarySecondQuarterAccomplishment = 0;
                                                $tertiaryUnitSecondQuarterCounter = $tertiaryUnitSecondQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiarySecondQuarterAccomplishment = $tertiarySecondQuarterAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitSecondQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment + $tertiarySecondQuarterAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitSecondQuarterCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_SecondQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>{{--THIRD QUARTER--}}
                            {{ round(($accomplishment->JulyTarget + $accomplishment->AugustTarget + $accomplishment->SeptemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->unit_accomplishment->JulyAccomplishment + $accomplishment->unit_accomplishment->AugustAccomplishment + $accomplishment->unit_accomplishment->SeptemberAccomplishment), 2) }}
                            <?php
                                $totalThirdQuarterContribution = 0;
                                $secondary_unit_ThirdQuarterchecker = null;
                                $tertiaryUnitThirdQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryThirdQuarterAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryThirdQuarterAccomplishment = $tertiaryThirdQuarterAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalThirdQuarterContribution = $contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment + $tertiaryThirdQuarterAccomplishment;
                                        $secondary_unit_ThirdQuarterchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_ThirdQuarterchecker != null && $totalThirdQuarterContribution != 0)
                                <b>+{{ $totalThirdQuarterContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryThirdQuarterAccomplishment = 0;
                                                $tertiaryUnitThirdQuarterCounter = $tertiaryUnitThirdQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryThirdQuarterAccomplishment = $tertiaryThirdQuarterAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitThirdQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment + $tertiaryThirdQuarterAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitThirdQuarterCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_ThirdQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>{{--FOURT QUARTER--}}
                            {{ round(($accomplishment->OctoberTarget + $accomplishment->NovemberTarget + $accomplishment->DecemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->unit_accomplishment->OctoberAccomplishment + $accomplishment->unit_accomplishment->NovemberAccomplishment + $accomplishment->unit_accomplishment->DecemberAccomplishment), 2) }}
                            <?php
                                $totalFourthQuarterContribution = 0;
                                $secondary_unit_FourthQuarterchecker = null;
                                $tertiaryUnitFourthQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryFourthQuarterAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryFourthQuarterAccomplishment = $tertiaryFourthQuarterAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalFourthQuarterContribution = $contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment + $tertiaryFourthQuarterAccomplishment;
                                        $secondary_unit_FourthQuarterchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_FourthQuarterchecker != null && $totalFourthQuarterContribution != 0)
                                <b>+{{ $totalFourthQuarterContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryFourthQuarterAccomplishment = 0;
                                                $tertiaryUnitFourthQuarterCounter = $tertiaryUnitFourthQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryFourthQuarterAccomplishment = $tertiaryFourthQuarterAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitFourthQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment + $tertiaryFourthQuarterAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitFourthQuarterCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_FourthQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
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
        @endforeach
    </table>
    @if($checkAccomplishment == 0)
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
    <?php

            $maxid = UnitAccomplishment::where('UnitID','=',$unit->UnitID)
                                        ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->max('updated_at');
            $maxid2 = UnitOwner::where('UnitID','=',$unit->UnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');
            $maxid3 = UnitInitiative::where('UnitID','=',$unit->UnitID)
                                    ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->max('updated_at');
            $maxid4 = UnitFunding::where('UnitID','=',$unit->UnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');


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
                //dd($checkAccomplishment);
    ?>
    @if($checkAccomplishment != 0)
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
    @endif
</body>