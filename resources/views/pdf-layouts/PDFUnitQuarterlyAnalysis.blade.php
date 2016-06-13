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
    $selectedQuarter = Session::get('quarter', 'default');    

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
    .label-gray 
    {
        background-color: #777;
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
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $unit->UnitAbbreviation }} KPI for Q{{ $selectedQuarter }} {{ $selectedYear }}</p>
    <table border="1">
        @if(count($accomplishments) != 0)
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
                $overallAccomplishment = 0;
                $overallTarget = 0;
            ?>
            <tbody>
                @foreach($accomplishments as $accomplishment)
                    <tr style="font-family: arial;">
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->unit_measure->UnitMeasureName }}
                            @if($accomplishment->unit_measure->StaffMeasureID > 0)
                                <br>
                                <span class="label label-primary">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                            @endif
                            <div style="font-size: 9px;font-style: italic;">Contributory/ies to this Measure</div>
                            @foreach($accomplishment->unit_measure->secondary_unit_measures as $contributor)
                                @foreach($contributor->secondary_unit_accomplishments as $contributory)
                                    <normal>
                                        <span class="label label-gray">{{ $contributory->secondary_unit->SecondaryUnitAbbreviation }}</span>
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
                            {{ $accomplishment->unit_measure->UnitMeasureFormula }}
                        </td>
                        @if($selectedQuarter == '1')
                            {{-- January --}}
                            <td>
                                {{ round($accomplishment->JanuaryTarget, 2) }}
                            <td>
                                <?php
                                    $totalJanuaryContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJanuaryAccomplishment = $accomplishment->unit_accomplishment->JanuaryAccomplishment + $totalJanuaryContribution;
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
                                    $JanuaryPerformance = round(($totalJanuaryAccomplishment / $accomplishment->JanuaryTarget) * 100, 2);
                                ?>
                                {{ round($JanuaryPerformance, 2) }}%
                            </td>
                            {{-- February --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            <td>
                                <?php
                                    $totalFebruaryContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalFebruaryAccomplishment = $accomplishment->unit_accomplishment->FebruaryAccomplishment + $totalFebruaryContribution;
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
                                    $FebruaryPerformance = round(($totalFebruaryAccomplishment / $accomplishment->FebruaryTarget) * 100, 2);
                                ?>
                                {{ round($FebruaryPerformance, 2) }}%
                            </td>
                            {{-- March --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            <td>
                                <?php
                                    $totalMarchContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMarchAccomplishment = $accomplishment->unit_accomplishment->MarchAccomplishment + $totalMarchContribution;
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
                                    $MarchPerformance = round(($totalMarchAccomplishment / $accomplishment->MarchTarget) * 100, 2);
                                ?>
                                {{ round($MarchPerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '2')
                            {{-- April --}}
                            <td>
                                {{ round($accomplishment->AprilTarget, 2) }}
                            <td>
                                <?php
                                    $totalAprilContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAprilAccomplishment = $accomplishment->unit_accomplishment->AprilAccomplishment + $totalAprilContribution;
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
                                    $AprilPerformance = round(($totalAprilAccomplishment / $accomplishment->AprilTarget) * 100, 2);
                                ?>
                                {{ round($AprilPerformance, 2) }}%
                            </td>
                            {{-- May --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            <td>
                                <?php
                                    $totalMayContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMayAccomplishment = $accomplishment->unit_accomplishment->MayAccomplishment + $totalMayContribution;
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
                                    $MayPerformance = round(($totalMayAccomplishment / $accomplishment->MayTarget) * 100, 2);
                                ?>
                                {{ round($MayPerformance, 2) }}%
                            </td>
                            {{-- June --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            <td>
                                <?php
                                    $totalJuneContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJuneAccomplishment = $accomplishment->unit_accomplishment->JuneAccomplishment + $totalJuneContribution;
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
                                    $JunePerformance = round(($totalJuneAccomplishment / $accomplishment->JuneTarget) * 100, 2);
                                ?>
                                {{ round($JunePerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '3')
                            {{-- July --}}
                            <td>
                                {{ round($accomplishment->JulyTarget, 2) }}
                            <td>
                                <?php
                                    $totalJulyContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJulyAccomplishment = $accomplishment->unit_accomplishment->JulyAccomplishment + $totalJulyContribution;
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
                                    $JulyPerformance = round(($totalJulyAccomplishment / $accomplishment->JulyTarget) * 100, 2);
                                ?>
                                {{ round($JulyPerformance, 2) }}%
                            </td>
                            {{-- August --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            <td>
                                <?php
                                    $totalAugustContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAugustAccomplishment = $accomplishment->unit_accomplishment->AugustAccomplishment + $totalAugustContribution;
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
                                    $AugustPerformance = round(($totalAugustAccomplishment / $accomplishment->AugustTarget) * 100, 2);
                                ?>
                                {{ round($AugustPerformance, 2) }}%
                            </td>
                            {{-- September --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            <td>
                                <?php
                                    $totalSeptemberContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalSeptemberAccomplishment = $accomplishment->unit_accomplishment->SeptemberAccomplishment + $totalSeptemberContribution;
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
                                    $SeptemberPerformance = round(($totalSeptemberAccomplishment / $accomplishment->SeptemberTarget) * 100, 2);
                                ?>
                                {{ round($SeptemberPerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '4')
                            {{-- October --}}
                            <td>
                                {{ round($accomplishment->OctoberTarget, 2) }}
                            <td>
                                <?php
                                    $totalOctoberContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalOctoberAccomplishment = $accomplishment->unit_accomplishment->OctoberAccomplishment + $totalOctoberContribution;
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
                                    $OctoberPerformance = round(($totalOctoberAccomplishment / $accomplishment->OctoberTarget) * 100, 2);
                                ?>
                                {{ round($OctoberPerformance, 2) }}%
                            </td>
                            {{-- November --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            <td>
                                <?php
                                    $totalNovemberContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalNovemberAccomplishment = $accomplishment->unit_accomplishment->NovemberAccomplishment + $totalNovemberContribution;
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
                                    $NovemberPerformance = round(($totalNovemberAccomplishment / $accomplishment->NovemberTarget) * 100, 2);
                                ?>
                                {{ round($NovemberPerformance, 2) }}%
                            </td>
                            {{-- December --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            <td>
                                <?php
                                    $totalDecemberContribution = 0;
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
                                        ?>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalDecemberAccomplishment = $accomplishment->unit_accomplishment->DecemberAccomplishment + $totalDecemberContribution;
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
                                    $DecemberPerformance = round(($totalDecemberAccomplishment / $accomplishment->DecemberTarget) * 100, 2);
                                ?>
                                {{ round($DecemberPerformance, 2) }}%
                            </td>
                        @endif

                        @if($accomplishment->unit_measure->UnitMeasureFormula == 'Summation')
                            <?php
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
                                <font color="{{$Color}}"><b>{{ round(($overallAccomplishment/$overallTarget) * 100, 2) }}%</b></font>
                            </td>   
                        @else
                            <?php
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
                                <font color="{{$Color}}"><b>{{ round((($overallAccomplishment/3)/$overallTarget)* 100, 2) }}%</b></font>
                            </td>
                        @endif 
                    </tr>
                @endforeach
            </tbody>
        @endforeach
    </table>
    @if(count($accomplishments) == 0)
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
</body>