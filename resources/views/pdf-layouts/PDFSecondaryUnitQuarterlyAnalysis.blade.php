<?php
	
//Freelance Models
use App\UserSecondaryUnit;
use App\SecondaryUnit;
use App\SecondaryUnitObjective;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitTarget;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnit;
use App\SecondaryUnitOwner;
use App\SecondaryUnitAccomplishment;
use App\SecondaryUnitFunding;

use App\SecondaryUnitInitiative;

	$selectedYear = Session::get('year', 'default');
    $selectedQuarter = Session::get('quarter', 'default');  	

 	$secondary_unit_id = Session::get('secondary_user_id', 'default');
    $user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
                ->with('secondary_unit')
                ->first();//dd($user);
    $secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->first();

	$logoPath = 'img/pnp_logo2.png';
	$secondaryunitlogoPath = 'uploads/secondaryunitpictures/cropped/'.$secondary_unit->PicturePath;

    $sortByObjective = DB::table('secondary_unit_objectives')
                        ->join('secondary_unit_measures', 'secondary_unit_objectives.SecondaryUnitObjectiveID', '=', 'secondary_unit_measures.SecondaryUnitObjectiveID')
                        ->where('secondary_unit_objectives.SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)
                        ->orderBy('secondary_unit_objectives.SecondaryUnitObjectiveName', 'asc')
                        ->get();//dd($sortByObjective);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = SecondaryUnitTarget::with('secondary_unit_measure')
                                ->with('secondary_unit_measure.secondary_unit_objective')
                                ->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments')
                                ->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments.tertiary_unit')
                                ->with('secondary_unit_accomplishment')
                                ->with('secondary_unit_owner')
                                ->with('secondary_unit_initiative')
                                ->with('secondary_unit_funding')
                                ->with('user_secondary_unit')
                                ->with('user_secondary_unit.rank')
                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->where('SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)
                                ->where('SecondaryUnitMeasureID', '=', $measure->SecondaryUnitMeasureID)
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
    .label-primary 
    {
        background-color: #337ab7;
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
	<img class="unitlogo" src="{{URL::asset($secondaryunitlogoPath)}}" style="height: 120px;width: 120px;">
	<p style="text-align: center;">
		<normal style="font-size: 15px">Republic of the Philippines</normal>
		<br>
		<strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
		<br>
		<normal style="font-size: 15px">{{ $secondary_unit->SecondaryUnitName }}</normal>
		<br>
		<normal style="font-size: 10px">usc.pulis.net</normal>
	</p>
	<p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $secondary_unit->SecondaryUnitAbbreviation }} KPI for Q{{ $selectedQuarter }} {{ $selectedYear }}</p>
    <table border="1">
        @if(count($checkAccomplishment) != 0)
            <thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="110px" rowspan="2" style="text-align: left;padding-left: 3px;">Formula</td>
                    @if($selectedQuarter == '1')
                        <td colspan="4" height="12">January</td>
                        <td colspan="4" height="12">February</td>
                        <td colspan="4" height="12">March</td>
                    @endif
                    @if($selectedQuarter == '2')
                        <td colspan="4" height="12">April</td>
                        <td colspan="4" height="12">May</td>
                        <td colspan="4" height="12">June</td>
                    @endif
                    @if($selectedQuarter == '3')
                        <td colspan="4" height="12">July</td>
                        <td colspan="4" height="12">August</td>
                        <td colspan="4" height="12">September</td>
                    @endif
                    @if($selectedQuarter == '4')
                        <td colspan="4" height="12">October</td>
                        <td colspan="4" height="12">November</td>
                        <td colspan="4" height="12">December</td>
                    @endif
                    <td colspan="2" height="12">Overall</td>
                </tr>
                <tr>
                    <td width="144px" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="1%">LG</td>
                    <td width="1%">LD</td>
                    <td width="55px">T</td>
                    <td width="55px">A</td>
                    <td width="55px">V</td>
                    <td width="55px">%</td>
                    <td width="55px">T</td>
                    <td width="55px">A</td>
                    <td width="55px">V</td>
                    <td width="55px">%</td>
                    <td width="55px">T</td>
                    <td width="55px">A</td>
                    <td width="55px">V</td>
                    <td width="55px">%</td>
                    <td width="65px">V</td>
                    <td width="65px">%</td>
                </tr>   
            </thead>
        @endif
        @foreach($sortByObjective as $measure)
            <?php
                $accomplishments = SecondaryUnitTarget::with('secondary_unit_measure')
                                ->with('secondary_unit_measure.secondary_unit_objective')
                                ->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments')
                                ->with('secondary_unit_measure.tertiary_unit_measures.tertiary_unit_accomplishments.tertiary_unit')
                                ->with('secondary_unit_accomplishment')
                                ->with('secondary_unit_owner')
                                ->with('secondary_unit_initiative')
                                ->with('secondary_unit_funding')
                                ->with('user_secondary_unit')
                                ->with('user_secondary_unit.rank')
                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->where('SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)
                                ->where('SecondaryUnitMeasureID', '=', $measure->SecondaryUnitMeasureID)
                                ->get();
                foreach ($accomplishments as $accomplishment)
                {
                    //dd($accomplishment);
                }
                //dd($accomplishments);
                $overallAccomplishment = 0;
                $overallTarget = 0;
            ?>
            <tbody>
                @foreach($accomplishments as $accomplishment)
                    <tr>
                        <td style="vertical-align: top;text-align: left;">
                                {{ $accomplishment->secondary_unit_measure->SecondaryUnitMeasureName }}
                                @if($accomplishment->secondary_unit_measure->UnitMeasureID > 0)
                                    <span class="label label-primary">Contributory to Unit, PNP</span>
                                @endif
                                <div style="font-size: 9px;font-style: italic;">Contributory/ies to this Measure</div>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <div style="font-size: 9px;">
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        </div>
                                    @endforeach
                                @endforeach
                        </td>
                        @if($accomplishment->secondary_unit_measure->SecondaryUnitMeasureType == 'LG')
                            <td style="background-color: #5cb85c;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #5cb85c;"></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->secondary_unit_measure->SecondaryUnitMeasureFormula }}
                        </td>
                        @if($selectedQuarter == '1')
                            {{-- JANUARY --}}
                            <td>
                                {{ round($accomplishment->JanuaryTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalJanuaryContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJanuaryContribution = $totalJanuaryContribution + $contributory->JanuaryAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJanuaryAccomplishment = $accomplishment->secondary_unit_accomplishment->JanuaryAccomplishment + $totalJanuaryContribution;
                                ?>

                                {{ round($totalJanuaryAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JanuaryTarget-$totalJanuaryAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJanuaryAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JanuaryTarget;
                                    $JanuaryTarget = $accomplishment->JanuaryTarget;
                                    if($JanuaryTarget == 0)
                                        $JanuaryPerformance = 0;
                                    else
                                        $JanuaryPerformance = round(($totalJanuaryAccomplishment / $JanuaryTarget) * 100, 2);
                                ?>
                                {{ round($JanuaryPerformance, 2) }}%
                            </td>
                            {{-- FEBRUARY --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalFebruaryContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalFebruaryContribution = $totalFebruaryContribution + $contributory->FebruaryAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalFebruaryAccomplishment = $accomplishment->secondary_unit_accomplishment->FebruaryAccomplishment + $totalFebruaryContribution;
                                ?>

                                {{ round($totalFebruaryAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->FebruaryTarget-$totalFebruaryAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalFebruaryAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->FebruaryTarget;
                                    $FebruaryTarget = $accomplishment->FebruaryTarget;
                                    if($FebruaryTarget == 0)
                                        $FebruaryPerformance = 0;
                                    else
                                        $FebruaryPerformance = round(($totalFebruaryAccomplishment / $FebruaryTarget) * 100, 2);
                                ?>
                                {{ round($FebruaryPerformance, 2) }}%
                            </td>
                            {{-- MARCH --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalMarchContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalMarchContribution = $totalMarchContribution + $contributory->MarchAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMarchAccomplishment = $accomplishment->secondary_unit_accomplishment->MarchAccomplishment + $totalMarchContribution;
                                ?>

                                {{ round($totalMarchAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->MarchTarget-$totalMarchAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalMarchAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->MarchTarget;
                                    $MarchTarget = $accomplishment->MarchTarget;
                                    if($MarchTarget == 0)
                                        $MarchPerformance = 0;
                                    else
                                        $MarchPerformance = round(($totalMarchAccomplishment / $MarchTarget) * 100, 2);
                                ?>
                                {{ round($MarchPerformance, 2) }}%
                            </td>
                         @endif
                         @if($selectedQuarter == '2')
                            {{-- APRIL --}}
                            <td>
                                {{ round($accomplishment->AprilTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalAprilContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalAprilContribution = $totalAprilContribution + $contributory->AprilAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAprilAccomplishment = $accomplishment->secondary_unit_accomplishment->AprilAccomplishment + $totalAprilContribution;
                                ?>

                                {{ round($totalAprilAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->AprilTarget-$totalAprilAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalAprilAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->AprilTarget;
                                    $AprilTarget = $accomplishment->AprilTarget;
                                    if($AprilTarget == 0)
                                        $AprilPerformance = 0;
                                    else
                                        $AprilPerformance = round(($totalAprilAccomplishment / $AprilTarget) * 100, 2);
                                ?>
                                {{ round($AprilPerformance, 2) }}%
                            </td>
                            {{-- MAY --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalMayContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalMayContribution = $totalMayContribution + $contributory->MayAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMayAccomplishment = $accomplishment->secondary_unit_accomplishment->MayAccomplishment + $totalMayContribution;
                                ?>

                                {{ round($totalMayAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->MayTarget-$totalMayAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalMayAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->MayTarget;
                                    $MayTarget = $accomplishment->MayTarget;
                                    if($MayTarget == 0)
                                        $MayPerformance = 0;
                                    else
                                        $MayPerformance = round(($totalMayAccomplishment / $MayTarget) * 100, 2);
                                ?>
                                {{ round($MayPerformance, 2) }}%
                            </td>
                            {{-- MARCH --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalJuneContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJuneContribution = $totalJuneContribution + $contributory->JuneAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJuneAccomplishment = $accomplishment->secondary_unit_accomplishment->JuneAccomplishment + $totalJuneContribution;
                                ?>

                                {{ round($totalJuneAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JuneTarget-$totalJuneAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJuneAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JuneTarget;
                                    $JuneTarget = $accomplishment->JuneTarget;
                                    if($JuneTarget == 0)
                                        $JunePerformance = 0;
                                    else
                                        $JunePerformance = round(($totalJuneAccomplishment / $JuneTarget) * 100, 2);
                                ?>
                                {{ round($JunePerformance, 2) }}%
                            </td>
                         @endif
                         @if($selectedQuarter == '3')
                            {{-- JULY --}}
                            <td>
                                {{ round($accomplishment->JulyTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalJulyContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJulyContribution = $totalJulyContribution + $contributory->JulyAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJulyAccomplishment = $accomplishment->secondary_unit_accomplishment->JulyAccomplishment + $totalJulyContribution;
                                ?>

                                {{ round($totalJulyAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JulyTarget-$totalJulyAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJulyAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JulyTarget;
                                    $JulyTarget = $accomplishment->JulyTarget;
                                    if($JulyTarget == 0)
                                        $JulyPerformance = 0;
                                    else
                                        $JulyPerformance = round(($totalJulyAccomplishment / $JulyTarget) * 100, 2);
                                ?>
                                {{ round($JulyPerformance, 2) }}%
                            </td>
                            {{-- AUGUST --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalAugustContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalAugustContribution = $totalAugustContribution + $contributory->AugustAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAugustAccomplishment = $accomplishment->secondary_unit_accomplishment->AugustAccomplishment + $totalAugustContribution;
                                ?>

                                {{ round($totalAugustAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->AugustTarget-$totalAugustAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalAugustAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->AugustTarget;
                                    $AugustTarget = $accomplishment->AugustTarget;
                                    if($AugustTarget == 0)
                                        $AugustPerformance = 0;
                                    else
                                        $AugustPerformance = round(($totalAugustAccomplishment / $AugustTarget) * 100, 2);
                                ?>
                                {{ round($AugustPerformance, 2) }}%
                            </td>
                            {{-- SEPTEMBER --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalSeptemberContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalSeptemberContribution = $totalSeptemberContribution + $contributory->SeptemberAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalSeptemberAccomplishment = $accomplishment->secondary_unit_accomplishment->SeptemberAccomplishment + $totalSeptemberContribution;
                                ?>

                                {{ round($totalSeptemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->SeptemberTarget-$totalSeptemberAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalSeptemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->SeptemberTarget;
                                    $SeptemberTarget = $accomplishment->SeptemberTarget;
                                    if($SeptemberTarget == 0)
                                        $SeptemberPerformance = 0;
                                    else
                                        $SeptemberPerformance = round(($totalSeptemberAccomplishment / $SeptemberTarget) * 100, 2);
                                ?>
                                {{ round($SeptemberPerformance, 2) }}%
                            </td>
                         @endif
                         @if($selectedQuarter == '4')
                            {{-- OCTOBER --}}
                            <td>
                                {{ round($accomplishment->OctoberTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalOctoberContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalOctoberContribution = $totalOctoberContribution + $contributory->OctoberAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalOctoberAccomplishment = $accomplishment->secondary_unit_accomplishment->OctoberAccomplishment + $totalOctoberContribution;
                                ?>

                                {{ round($totalOctoberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->OctoberTarget-$totalOctoberAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalOctoberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->OctoberTarget;
                                    $OctoberTarget = $accomplishment->OctoberTarget;
                                    if($OctoberTarget == 0)
                                        $OctoberPerformance = 0;
                                    else
                                        $OctoberPerformance = round(($totalOctoberAccomplishment / $OctoberTarget) * 100, 2);
                                ?>
                                {{ round($OctoberPerformance, 2) }}%
                            </td>
                            {{-- NOVEMBER --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalNovemberContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalNovemberContribution = $totalNovemberContribution + $contributory->NovemberAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalNovemberAccomplishment = $accomplishment->secondary_unit_accomplishment->NovemberAccomplishment + $totalNovemberContribution;
                                ?>

                                {{ round($totalNovemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->NovemberTarget-$totalNovemberAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalNovemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->NovemberTarget;
                                    $NovemberTarget = $accomplishment->NovemberTarget;
                                    if($NovemberTarget == 0)
                                        $NovemberPerformance = 0;
                                    else
                                        $NovemberPerformance = round(($totalNovemberAccomplishment / $NovemberTarget) * 100, 2);
                                ?>
                                {{ round($NovemberPerformance, 2) }}%
                            </td>
                            {{-- DECEMBER --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            </td>
                             <td>
                                <?php
                                    $totalDecemberContribution = 0;
                                ?>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $contributor)
                                    @foreach($contributor->tertiary_unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalDecemberContribution = $totalDecemberContribution + $contributory->DecemberAccomplishment;
                                            ?>
                                        </div>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalDecemberAccomplishment = $accomplishment->secondary_unit_accomplishment->DecemberAccomplishment + $totalDecemberContribution;
                                ?>

                                {{ round($totalDecemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->DecemberTarget-$totalDecemberAccomplishment, 2) }}
                            </td>
                            
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalDecemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->DecemberTarget;
                                    $DecemberTarget = $accomplishment->DecemberTarget;
                                    if($DecemberTarget == 0)
                                        $DecemberPerformance = 0;
                                    else
                                        $DecemberPerformance = round(($totalDecemberAccomplishment / $DecemberTarget) * 100, 2);
                                ?>
                                {{ round($DecemberPerformance, 2) }}%
                            </td>
                         @endif
                         
                         @if($accomplishment->secondary_unit_measure->SecondaryUnitMeasureFormula == 'Summation')
                            <?php
                                if($overallTarget == 0)
                                    $performance = 0;
                                else
                                    $performance = round(($overallAccomplishment/$overallTarget)* 100, 2);

                                $Color = ""; 
                                if($performance >= 101)
                                    {
                                        $Color = "#00AA00";
                                    }           
                                elseif($performance >= 50 && $performance <= 100)
                                    {
                                        $Color = "#5cb85c";
                                    }
                                elseif($performance <  50 && $performance >= 26)
                                    {
                                        $Color = "#f0ad4e";
                                    }
                                elseif($performance <= 25 && $performance >= 1)
                                    {
                                        $Color = "#d9534f";
                                    }
                                else{}
                            ?>
                            <td>
                                <b>{{ round($overallAccomplishment-$overallTarget, 2) }}</b>
                            </td>
                            <td>
                                <font color="{{$Color}}"><b>{{ $performance }}%</b></font>
                            </td>   
                        @else
                            <?php
                                if($overallTarget == 0)
                                    $performance = 0;
                                else
                                    $performance = round((($overallAccomplishment/3)/$overallTarget)* 100, 2);

                                $Color = ""; 
                                if($performance >= 101)
                                    {
                                        $Color = "#00AA00";
                                    }           
                                elseif($performance >= 50 && $performance <= 100)
                                    {
                                        $Color = "#5cb85c";
                                    }
                                elseif($performance <  50 && $performance >= 26)
                                    {
                                        $Color = "#f0ad4e";
                                    }
                                elseif($performance <= 25 && $performance >= 1)
                                    {
                                        $Color = "#d9534f";
                                    }
                                else{}
                            ?>
                            <td>
                                <b>{{ round((($overallAccomplishment/3)-$overallTarget), 2) }}</b>
                            </td>
                            <td>
                                <font color="{{$Color}}"><b>{{ $performance }}%</b></font>
                            </td>
                        @endif 
                    </tr>
                @endforeach
            </tbody>
        @endforeach
    </table>
</body>