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
                    <td width="68" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td width="68" rowspan="2" style="text-align: left;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="80" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="32">Jan</td>
                    <td width="32">Feb</td>
                    <td width="32">Mar</td>
                    <td width="32">Apr</td>
                    <td width="32">May</td>
                    <td width="32">Jun</td>
                    <td width="32">Jul</td>
                    <td width="32">Aug</td>
                    <td width="32">Sep</td>
                    <td width="32">Oct</td>
                    <td width="32">Nov</td>
                    <td width="32">Dec</td>
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
            			<td>
            				{{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->JanuaryAccomplishment, 2) }}
                            <?php
                                $totalJanuaryContribution = 0;
                                $secondary_unit_Januarychecker = null;
                                $tertiaryUnitJanuaryCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryJanuaryAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryJanuaryAccomplishment = $tertiaryJanuaryAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalJanuaryContribution = $contributory->JanuaryAccomplishment + $tertiaryJanuaryAccomplishment;
                                        $secondary_unit_Januarychecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Januarychecker != null && $totalJanuaryContribution != 0)
                                <b>+{{ $totalJanuaryContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryJanuaryAccomplishment = 0;
                                                $tertiaryUnitJanuaryCounter = $tertiaryUnitJanuaryCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryJanuaryAccomplishment = $tertiaryJanuaryAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitJanuaryCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JanuaryAccomplishment + $tertiaryJanuaryAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitJanuaryCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Januarychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
            			</td>
                        <td>
                            {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->FebruaryAccomplishment, 2) }}
                            <?php
                                $totalFebruaryContribution = 0;
                                $secondary_unit_Februarychecker = null;
                                $tertiaryUnitFebruaryCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryFebruaryAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryFebruaryAccomplishment = $tertiaryFebruaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalFebruaryContribution = $contributory->FebruaryAccomplishment + $tertiaryFebruaryAccomplishment;
                                        $secondary_unit_Februarychecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Februarychecker != null && $totalFebruaryContribution != 0)
                                <b>+{{ $totalFebruaryContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryFebruaryAccomplishment = 0;
                                                $tertiaryUnitFebruaryCounter = $tertiaryUnitFebruaryCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryFebruaryAccomplishment = $tertiaryFebruaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitFebruaryCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->FebruaryAccomplishment + $tertiaryFebruaryAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitFebruaryCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Februarychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->MarchAccomplishment, 2) }}
                            <?php
                                $totalMarchContribution = 0;
                                $secondary_unit_Marchchecker = null;
                                $tertiaryUnitMarchCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryMarchAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryMarchAccomplishment = $tertiaryMarchAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalMarchContribution = $contributory->MarchAccomplishment + $tertiaryMarchAccomplishment;
                                        $secondary_unit_Marchchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Marchchecker != null && $totalMarchContribution != 0)
                                <b>+{{ $totalMarchContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryMarchAccomplishment = 0;
                                                $tertiaryUnitMarchCounter = $tertiaryUnitMarchCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryMarchAccomplishment = $tertiaryMarchAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitMarchCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->MarchAccomplishment + $tertiaryMarchAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitMarchCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Marchchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->AprilAccomplishment, 2) }}
                            <?php
                                $totalAprilContribution = 0;
                                $secondary_unit_Aprilchecker = null;
                                $tertiaryUnitAprilCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryAprilAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryAprilAccomplishment = $tertiaryAprilAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalAprilContribution = $contributory->AprilAccomplishment + $tertiaryAprilAccomplishment;
                                        $secondary_unit_Aprilchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Aprilchecker != null && $totalAprilContribution != 0)
                                <b>+{{ $totalAprilContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryAprilAccomplishment = 0;
                                                $tertiaryUnitAprilCounter = $tertiaryUnitAprilCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryAprilAccomplishment = $tertiaryAprilAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitAprilCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AprilAccomplishment + $tertiaryAprilAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitAprilCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Aprilchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->MayAccomplishment, 2) }}
                            <?php
                                $totalMayContribution = 0;
                                $secondary_unit_Maychecker = null;
                                $tertiaryUnitMayCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryMayAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryMayAccomplishment = $tertiaryMayAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalMayContribution = $contributory->MayAccomplishment + $tertiaryMayAccomplishment;
                                        $secondary_unit_Maychecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Maychecker != null && $totalMayContribution != 0)
                                <b>+{{ $totalMayContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryMayAccomplishment = 0;
                                                $tertiaryUnitMayCounter = $tertiaryUnitMayCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryMayAccomplishment = $tertiaryMayAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitMayCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->MayAccomplishment + $tertiaryMayAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitMayCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Maychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->JuneAccomplishment, 2) }}
                            <?php
                                $totalJuneContribution = 0;
                                $secondary_unit_Junechecker = null;
                                $tertiaryUnitJuneCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryJuneAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryJuneAccomplishment = $tertiaryJuneAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalJuneContribution = $contributory->JuneAccomplishment + $tertiaryJuneAccomplishment;
                                        $secondary_unit_Junechecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Junechecker != null && $totalJuneContribution != 0)
                                <b>+{{ $totalJuneContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryJuneAccomplishment = 0;
                                                $tertiaryUnitJuneCounter = $tertiaryUnitJuneCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryJuneAccomplishment = $tertiaryJuneAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitJuneCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JuneAccomplishment + $tertiaryJuneAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitJuneCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Junechecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->JulyAccomplishment, 2) }}
                            <?php
                                $totalJulyContribution = 0;
                                $secondary_unit_Julychecker = null;
                                $tertiaryUnitJulyCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryJulyAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryJulyAccomplishment = $tertiaryJulyAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalJulyContribution = $contributory->JulyAccomplishment + $tertiaryJulyAccomplishment;
                                        $secondary_unit_Julychecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Julychecker != null && $totalJulyContribution != 0)
                                <b>+{{ $totalJulyContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryJulyAccomplishment = 0;
                                                $tertiaryUnitJulyCounter = $tertiaryUnitJulyCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryJulyAccomplishment = $tertiaryJulyAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitJulyCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JulyAccomplishment + $tertiaryJulyAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitJulyCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Julychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->AugustAccomplishment, 2) }}
                            <?php
                                $totalAugustContribution = 0;
                                $secondary_unit_Augustchecker = null;
                                $tertiaryUnitAugustCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryAugustAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryAugustAccomplishment = $tertiaryAugustAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalAugustContribution = $contributory->AugustAccomplishment + $tertiaryAugustAccomplishment;
                                        $secondary_unit_Augustchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Augustchecker != null && $totalAugustContribution != 0)
                                <b>+{{ $totalAugustContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryAugustAccomplishment = 0;
                                                $tertiaryUnitAugustCounter = $tertiaryUnitAugustCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryAugustAccomplishment = $tertiaryAugustAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitAugustCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AugustAccomplishment + $tertiaryAugustAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitAugustCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Augustchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->SeptemberAccomplishment, 2) }}
                            <?php
                                $totalSeptemberContribution = 0;
                                $secondary_unit_Septemberchecker = null;
                                $tertiaryUnitSeptemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiarySeptemberAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiarySeptemberAccomplishment = $tertiarySeptemberAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalSeptemberContribution = $contributory->SeptemberAccomplishment + $tertiarySeptemberAccomplishment;
                                        $secondary_unit_Septemberchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Septemberchecker != null && $totalSeptemberContribution != 0)
                                <b>+{{ $totalSeptemberContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiarySeptemberAccomplishment = 0;
                                                $tertiaryUnitSeptemberCounter = $tertiaryUnitSeptemberCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiarySeptemberAccomplishment = $tertiarySeptemberAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitSeptemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->SeptemberAccomplishment + $tertiarySeptemberAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitSeptemberCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Septemberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->OctoberAccomplishment, 2) }}
                            <?php
                                $totalOctoberContribution = 0;
                                $secondary_unit_Octoberchecker = null;
                                $tertiaryUnitOctoberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryOctoberAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryOctoberAccomplishment = $tertiaryOctoberAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalOctoberContribution = $contributory->OctoberAccomplishment + $tertiaryOctoberAccomplishment;
                                        $secondary_unit_Octoberchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Octoberchecker != null && $totalOctoberContribution != 0)
                                <b>+{{ $totalOctoberContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryOctoberAccomplishment = 0;
                                                $tertiaryUnitOctoberCounter = $tertiaryUnitOctoberCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryOctoberAccomplishment = $tertiaryOctoberAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitOctoberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->OctoberAccomplishment + $tertiaryOctoberAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitOctoberCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Octoberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->NovemberAccomplishment, 2) }}
                            <?php
                                $totalNovemberContribution = 0;
                                $secondary_unit_Novemberchecker = null;
                                $tertiaryUnitNovemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryNovemberAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryNovemberAccomplishment = $tertiaryNovemberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalNovemberContribution = $contributory->NovemberAccomplishment + $tertiaryNovemberAccomplishment;
                                        $secondary_unit_Novemberchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Novemberchecker != null && $totalNovemberContribution != 0)
                                <b>+{{ $totalNovemberContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryNovemberAccomplishment = 0;
                                                $tertiaryUnitNovemberCounter = $tertiaryUnitNovemberCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryNovemberAccomplishment = $tertiaryNovemberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitNovemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->NovemberAccomplishment + $tertiaryNovemberAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitNovemberCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Novemberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->unit_accomplishment->DecemberAccomplishment, 2) }}
                            <?php
                                $totalDecemberContribution = 0;
                                $secondary_unit_Decemberchecker = null;
                                $tertiaryUnitDecemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <?php
                                        $tertiaryDecemberAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                        @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                            <?php
                                                $tertiaryDecemberAccomplishment = $tertiaryDecemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                            ?>
                                        @endforeach
                                    @endforeach
                                    <?php
                                        $totalDecemberContribution = $contributory->DecemberAccomplishment + $tertiaryDecemberAccomplishment;
                                        $secondary_unit_Decemberchecker = $contributory->secondary_unit->SecondaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($secondary_unit_Decemberchecker != null && $totalDecemberContribution != 0)
                                <b>+{{ $totalDecemberContribution }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                        @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                            <?php
                                                $tertiaryDecemberAccomplishment = 0;
                                                $tertiaryUnitDecemberCounter = $tertiaryUnitDecemberCounter + 1;
                                            ?>
                                            @foreach($contributor->tertiary_unit_measures as $tertiaryContributory)           
                                                @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                    <?php
                                                        $tertiaryDecemberAccomplishment = $tertiaryDecemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                            <normal>
                                                @if($tertiaryUnitDecemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->DecemberAccomplishment + $tertiaryDecemberAccomplishment), 2) }}</b>-<span class="label label-default">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>@if($tertiaryUnitDecemberCounter != count($contributor->secondary_unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($secondary_unit_Decemberchecker != null)
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