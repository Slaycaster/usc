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
    $reportType = Session::get('reportType', 'default');    

    $secondary_unit_id = Session::get('secondary_unit_id', 'default');

    $secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $secondary_unit_id)->first();

    $user = UserSecondaryUnit::where('SecondaryUnitID', $secondary_unit_id)
                                ->first();

    $logoPath = 'img/pnp_logo2.png';
    $secondaryunitlogoPath = 'uploads/secondaryunitpictures/cropped/'.$secondary_unit->PicturePath;
    $tempObjective = '';

    $sortByObjective = DB::table('secondary_unit_objectives')
                        ->join('secondary_unit_measures', 'secondary_unit_objectives.SecondaryUnitObjectiveID', '=', 'secondary_unit_measures.SecondaryUnitObjectiveID')
                        ->where('secondary_unit_objectives.SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)
                        ->orderBy('secondary_unit_objectives.SecondaryUnitObjectiveName', 'asc')
                        ->orderBy('secondary_unit_measures.SecondaryUnitMeasureID', 'asc')
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
        font-size: 60%;
        font-family: helvetica;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;    }
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
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $secondary_unit->SecondaryUnitAbbreviation }} Scorecard for {{ $selectedYear }}</p>
    <table border="1">
        @if(count($checkAccomplishment) != 0)
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
            ?>
            <tbody>
                @foreach($accomplishments as $accomplishment)
                   <tr style="font-family: arial;">
                        @if($tempObjective != $accomplishment->secondary_unit_measure->secondary_unit_objective->SecondaryUnitObjectiveName)
                            <?php
                                $tempObjective = $accomplishment->secondary_unit_measure->secondary_unit_objective->SecondaryUnitObjectiveName;
                            ?>
                            <td style="vertical-align: top;text-align: left;">
                                {{ $accomplishment->secondary_unit_measure->secondary_unit_objective->SecondaryUnitObjectiveName }}
                            </td>
                        @else
                            <td></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->secondary_unit_measure->SecondaryUnitMeasureName }}
                            @if($accomplishment->secondary_unit_measure->UnitMeasureID > 0)
                                <span class="labelc label-primary">Contributory {{ $user->secondary_unit->unit->UnitAbbreviation }}</span>
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
                            {{ $accomplishment->secondary_unit_owner->SecondaryUnitOwnerContent }}
                        </td>
                        <td>
                            {{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->JanuaryAccomplishment }}
                            <br>
                            <?php
                                $JanuaryTertiaryTotalContribution = 0;
                                $tertiary_unit_Januarychecker = null;
                                $secondaryUnitJanuaryCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JanuaryTertiaryTotalContribution = $JanuaryTertiaryTotalContribution + $tertiary_unit_accomplishment->JanuaryAccomplishment;
                                        $tertiary_unit_Januarychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Januarychecker != null)
                                <b>+{{ $JanuaryTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitJanuaryCounter = $secondaryUnitJanuaryCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitJanuaryCounter == 1)(@endif{{ $tertiary_unit_accomplishment->JanuaryAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Januarychecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->FebruaryAccomplishment }}
                            <br>
                            <?php
                                $FebruaryTertiaryTotalContribution = 0;
                                $tertiary_unit_Februarychecker = null;
                                $secondaryUnitFebruaryCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $FebruaryTertiaryTotalContribution = $FebruaryTertiaryTotalContribution + $tertiary_unit_accomplishment->FebruaryAccomplishment;
                                        $tertiary_unit_Februarychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Februarychecker != null)
                                <b>+{{ $FebruaryTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitFebruaryCounter = $secondaryUnitFebruaryCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitFebruaryCounter == 1)(@endif{{ $tertiary_unit_accomplishment->FebruaryAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Februarychecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->MarchAccomplishment }}
                            <br>
                            <?php
                                $MarchTertiaryTotalContribution = 0;
                                $tertiary_unit_Marchchecker = null;
                                $secondaryUnitMarchCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $MarchTertiaryTotalContribution = $MarchTertiaryTotalContribution + $tertiary_unit_accomplishment->MarchAccomplishment;
                                        $tertiary_unit_Marchchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Marchchecker != null)
                                <b>+{{ $MarchTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitMarchCounter = $secondaryUnitMarchCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitMarchCounter == 1)(@endif{{ $tertiary_unit_accomplishment->MarchAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Marchchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->AprilAccomplishment }}
                            <br>
                            <?php
                                $AprilTertiaryTotalContribution = 0;
                                $tertiary_unit_Aprilchecker = null;
                                $secondaryUnitAprilCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $AprilTertiaryTotalContribution = $AprilTertiaryTotalContribution + $tertiary_unit_accomplishment->AprilAccomplishment;
                                        $tertiary_unit_Aprilchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Aprilchecker != null)
                                <b>+{{ $AprilTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitAprilCounter = $secondaryUnitAprilCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitAprilCounter == 1)(@endif{{ $tertiary_unit_accomplishment->AprilAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Aprilchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->MayAccomplishment }}
                            <br>
                            <?php
                                $MayTertiaryTotalContribution = 0;
                                $tertiary_unit_Maychecker = null;
                                $secondaryUnitMayCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $MayTertiaryTotalContribution = $MayTertiaryTotalContribution + $tertiary_unit_accomplishment->MayAccomplishment;
                                        $tertiary_unit_Maychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Maychecker != null)
                                <b>+{{ $MayTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitMayCounter = $secondaryUnitMayCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitMayCounter == 1)(@endif{{ $tertiary_unit_accomplishment->MayAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Maychecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->JuneAccomplishment }}
                            <br>
                            <?php
                                $JuneTertiaryTotalContribution = 0;
                                $tertiary_unit_Junechecker = null;
                                $secondaryUnitJuneCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JuneTertiaryTotalContribution = $JuneTertiaryTotalContribution + $tertiary_unit_accomplishment->JuneAccomplishment;
                                        $tertiary_unit_Junechecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Junechecker != null)
                                <b>+{{ $JuneTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitJuneCounter = $secondaryUnitJuneCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitJuneCounter == 1)(@endif{{ $tertiary_unit_accomplishment->JuneAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Junechecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->JulyAccomplishment }}
                            <br>
                            <?php
                                $JulyTertiaryTotalContribution = 0;
                                $tertiary_unit_Julychecker = null;
                                $secondaryUnitJulyCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JulyTertiaryTotalContribution = $JulyTertiaryTotalContribution + $tertiary_unit_accomplishment->JulyAccomplishment;
                                        $tertiary_unit_Julychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Julychecker != null)
                                <b>+{{ $JulyTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitJulyCounter = $secondaryUnitJulyCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitJulyCounter == 1)(@endif{{ $tertiary_unit_accomplishment->JulyAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Julychecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->AugustAccomplishment }}
                            <br>
                            <?php
                                $AugustTertiaryTotalContribution = 0;
                                $tertiary_unit_Augustchecker = null;
                                $secondaryUnitAugustCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $AugustTertiaryTotalContribution = $AugustTertiaryTotalContribution + $tertiary_unit_accomplishment->AugustAccomplishment;
                                        $tertiary_unit_Augustchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Augustchecker != null)
                                <b>+{{ $AugustTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitAugustCounter = $secondaryUnitAugustCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitAugustCounter == 1)(@endif{{ $tertiary_unit_accomplishment->AugustAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Augustchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->SeptemberAccomplishment }}
                            <br>
                            <?php
                                $SeptemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Septemberchecker = null;
                                $secondaryUnitSeptemberCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $SeptemberTertiaryTotalContribution = $SeptemberTertiaryTotalContribution + $tertiary_unit_accomplishment->SeptemberAccomplishment;
                                        $tertiary_unit_Septemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Septemberchecker != null)
                                <b>+{{ $SeptemberTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitSeptemberCounter = $secondaryUnitSeptemberCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitSeptemberCounter == 1)(@endif{{ $tertiary_unit_accomplishment->SeptemberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Septemberchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->OctoberAccomplishment }}
                            <br>
                            <?php
                                $OctoberTertiaryTotalContribution = 0;
                                $tertiary_unit_Octoberchecker = null;
                                $secondaryUnitOctoberCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $OctoberTertiaryTotalContribution = $OctoberTertiaryTotalContribution + $tertiary_unit_accomplishment->OctoberAccomplishment;
                                        $tertiary_unit_Octoberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Octoberchecker != null)
                                <b>+{{ $OctoberTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitOctoberCounter = $secondaryUnitOctoberCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitOctoberCounter == 1)(@endif{{ $tertiary_unit_accomplishment->OctoberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Octoberchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->NovemberAccomplishment }}
                            <br>
                            <?php
                                $NovemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Novemberchecker = null;
                                $secondaryUnitNovemberCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $NovemberTertiaryTotalContribution = $NovemberTertiaryTotalContribution + $tertiary_unit_accomplishment->NovemberAccomplishment;
                                        $tertiary_unit_Novemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Novemberchecker != null)
                                <b>+{{ $NovemberTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitNovemberCounter = $secondaryUnitNovemberCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitNovemberCounter == 1)(@endif{{ $tertiary_unit_accomplishment->NovemberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Novemberchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->secondary_unit_accomplishment->DecemberAccomplishment }}
                            <br>
                            <?php
                                $DecemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Decemberchecker = null;
                                $secondaryUnitDecemberCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $DecemberTertiaryTotalContribution = $DecemberTertiaryTotalContribution + $tertiary_unit_accomplishment->DecemberAccomplishment;
                                        $tertiary_unit_Decemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_Decemberchecker != null)
                                <b>+{{ $DecemberTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitDecemberCounter = $secondaryUnitDecemberCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitDecemberCounter == 1)(@endif{{ $tertiary_unit_accomplishment->DecemberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_Decemberchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->secondary_unit_initiative->SecondaryUnitInitiativeContent }}
                        </td>
                        <td style="text-align: right;">
                            {{ round($accomplishment->secondary_unit_funding->SecondaryUnitFundingEstimate, 2) }}
                        </td>
                        <td style="text-align: right;">
                            {{ round($accomplishment->secondary_unit_funding->SecondaryUnitFundingActual, 2) }}
                        </td>
                        <td style="text-align: right;">
                            {{ round(($accomplishment->secondary_unit_funding->SecondaryUnitFundingEstimate - $accomplishment->secondary_unit_funding->SecondaryUnitFundingActual), 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endforeach
    </table>
    @if(count($checkAccomplishment) == 0)
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
    <?php

            $maxid = SecondaryUnitAccomplishment::where('SecondaryUnitID','=',$secondary_unit->SecondaryUnitID)
                                        ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->max('updated_at');
            $maxid2 = SecondaryUnitOwner::where('SecondaryUnitID','=',$secondary_unit->SecondaryUnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');
            $maxid3 = SecondaryUnitInitiative::where('SecondaryUnitID','=',$secondary_unit->SecondaryUnitID)
                                    ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->max('updated_at');
            $maxid4 = SecondaryUnitFunding::where('SecondaryUnitID','=',$secondary_unit->SecondaryUnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');


            $updatedby = SecondaryUnitAccomplishment::where('updated_at','=',$maxid)
                ->with('user_secondary_unit')
                ->with('user_secondary_unit.rank')
                ->first();

            $updatedby2 = SecondaryUnitOwner::where('updated_at','=',$maxid2)
                ->with('user_secondary_unit')
                ->with('user_secondary_unit.rank')
                ->first(); 

            $updatedby3 = SecondaryUnitInitiative::where('updated_at','=',$maxid3)
                ->with('user_secondary_unit')
                ->with('user_secondary_unit.rank')
                ->first();

            $updatedby4 = SecondaryUnitFunding::where('updated_at','=',$maxid4)
                ->with('user_secondary_unit')
                ->with('user_secondary_unit.rank')
                ->first(); 

        //dd($updatedby);
    ?>
    <br>
    @if(count($checkAccomplishment) != 0)
        <div>
            <i>
                Accomplishment last updated by: 
                <b>{{ $updatedby->user_secondary_unit->rank->RankCode }} {{ $updatedby->user_secondary_unit->UserSecondaryUnitLastName }}, {{ $updatedby->user_secondary_unit->UserSecondaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Owner last updated by:  
                <b>{{ $updatedby2->user_secondary_unit->rank->RankCode }} {{ $updatedby2->user_secondary_unit->UserSecondaryUnitLastName }}, {{ $updatedby2->user_secondary_unit->UserSecondaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby2->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby2->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Initiative last updated by:  
                <b>{{ $updatedby3->user_secondary_unit->rank->RankCode }} {{ $updatedby3->user_secondary_unit->UserSecondaryUnitLastName }}, {{ $updatedby3->user_secondary_unit->UserSecondaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby3->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby3->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Funding last updated by:  
                <b>{{ $updatedby4->user_secondary_unit->rank->RankCode }} {{ $updatedby4->user_secondary_unit->UserSecondaryUnitLastName }}, {{ $updatedby4->user_secondary_unit->UserSecondaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby4->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby4->updated_at)) }}</b>
            </i>

        </div>
    @endif
</body>