<?php
    
//Freelance Models
use App\UserTertiaryUnit;
use App\TertiaryUnitObjective;
use App\TertiaryUnitMeasure;
use App\TertiaryUnitTarget;
use App\TertiaryUnitAccomplishment;
use App\TertiaryUnit;
use App\TertiaryUnitOwner;
use App\TertiaryUnitFunding;

use App\TertiaryUnitInitiative;


    $selectedYear = Session::get('year', 'default');
    $reportType = Session::get('reportType', 'default');    

    $tertiary_unit_id = Session::get('tertiary_user_id', 'default');
    $user = UserTertiaryUnit::where('UserTertiaryUnitID', $tertiary_unit_id)
                ->with('tertiary_unit')
                ->first();//dd($user);
    $tertiary_unit = TertiaryUnit::where('TertiaryUnitID', '=', $tertiary_unit_id)->first();
 

    $user = UserTertiaryUnit::where('UserTertiaryUnitID', $tertiary_unit_id)
                    ->first();

    $logoPath = 'img/pnp_logo2.png';
    $tertiaryunitlogoPath = 'uploads/tertiaryunitpictures/cropped/'.$tertiary_unit->PicturePath;
    $tempObjective = '';

    $sortByObjective = DB::table('tertiary_unit_objectives')
                        ->join('tertiary_unit_measures', 'tertiary_unit_objectives.TertiaryUnitObjectiveID', '=', 'tertiary_unit_measures.TertiaryUnitObjectiveID')
                        ->where('tertiary_unit_objectives.TertiaryUnitID', '=', $tertiary_unit->TertiaryUnitID)
                        ->orderBy('Tertiary_unit_objectives.TertiaryUnitObjectiveName', 'asc')
                        ->orderBy('tertiary_unit_measures.TertiaryUnitMeasureID', 'asc')
                        ->get();//dd($sortByObjective);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = TertiaryUnitTarget::with('tertiary_unit_measure')
                                ->with('tertiary_unit_measure.tertiary_unit_objective')
                                ->with('tertiary_unit_measure.tertiary_unit_accomplishments')
                                ->with('tertiary_unit_measure.tertiary_unit_accomplishments.tertiary_unit')
                                ->with('tertiary_unit_accomplishment')
                                ->with('tertiary_unit_owner')
                                ->with('tertiary_unit_initiative')
                                ->with('tertiary_unit_funding')
                                ->with('user_tertiary_unit')
                                ->with('user_tertiary_unit.rank')
                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->where('TertiaryUnitID', '=', $tertiary_unit->TertiaryUnitID)
                                ->where('TertiaryUnitMeasureID', '=', $measure->TertiaryUnitMeasureID)
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
    <img class="unitlogo" src="{{URL::asset($tertiaryunitlogoPath)}}" style="height: 120px;width: 120px;">
    <p style="text-align: center;">
        <normal style="font-size: 15px">Republic of the Philippines</normal>
        <br>
        <strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
        <br>
        <normal style="font-size: 15px">{{ $tertiary_unit->TertiaryUnitName }}</normal>
        <br>
        <normal style="font-size: 10px">usc.pulis.net</normal>
    </p>
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $tertiary_unit->TertiaryUnitAbbreviation }} Scorecard for {{ $selectedYear }}</p>
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
                $accomplishments = TertiaryUnitTarget::with('tertiary_unit_measure')
                                ->with('tertiary_unit_measure.tertiary_unit_objective')
                                ->with('tertiary_unit_measure.tertiary_unit_accomplishments')
                                ->with('tertiary_unit_measure.tertiary_unit_accomplishments.tertiary_unit')
                                ->with('tertiary_unit_accomplishment')
                                ->with('tertiary_unit_owner')
                                ->with('tertiary_unit_initiative')
                                ->with('tertiary_unit_funding')
                                ->with('user_tertiary_unit')
                                ->with('user_tertiary_unit.rank')
                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->where('TertiaryUnitID', '=', $tertiary_unit->TertiaryUnitID)
                                ->where('TertiaryUnitMeasureID', '=', $measure->TertiaryUnitMeasureID)
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
                        @if($tempObjective != $accomplishment->tertiary_unit_measure->tertiary_unit_objective->TertiaryUnitObjectiveName)
                            <?php
                                $tempObjective = $accomplishment->tertiary_unit_measure->tertiary_unit_objective->TertiaryUnitObjectiveName;
                            ?>
                            <td style="vertical-align: top;text-align: left;">
                                {{ $accomplishment->tertiary_unit_measure->tertiary_unit_objective->TertiaryUnitObjectiveName }}
                                
                            </td>
                        @else
                            <td></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->tertiary_unit_measure->TertiaryUnitMeasureName }}
                            @if($accomplishment->tertiary_unit_measure->SecondaryUnitMeasureID > 0)
                                <br>
                                <span class="label label-primary">Contributory to {{ $tertiary_unit->secondary_unit->SecondaryUnitAbbreviation }}</span>
                            @endif
                            
                        </td>
                        @if($accomplishment->tertiary_unit_measure->TertiaryUnitMeasureType == 'LG')
                            <td style="background-color: #5cb85c;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #5cb85c;"></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->tertiary_unit_owner->TertiaryUnitOwnerContent }}
                        </td>
                        <td>
                            {{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->JanuaryAccomplishment }}
                            <br>
                            <?php
                                $JanuaryTertiaryTotalContribution = 0;
                                $tertiary_unit_Januarychecker = null;
                                $TertiaryUnitJanuaryCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JanuaryTertiaryTotalContribution = $JanuaryTertiaryTotalContribution + $tertiary_unit_accomplishment->JanuaryAccomplishment;
                                        $tertiary_unit_Januarychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                        
                            
                        </td>
                        <td>
                            {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->FebruaryAccomplishment }}
                            <br>
                            <?php
                                $FebruaryTertiaryTotalContribution = 0;
                                $tertiary_unit_Februarychecker = null;
                                $TertiaryUnitFebruaryCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $FebruaryTertiaryTotalContribution = $FebruaryTertiaryTotalContribution + $tertiary_unit_accomplishment->FebruaryAccomplishment;
                                        $tertiary_unit_Februarychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->MarchAccomplishment }}
                            <br>
                            <?php
                                $MarchTertiaryTotalContribution = 0;
                                $tertiary_unit_Marchchecker = null;
                                $TertiaryUnitMarchCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $MarchTertiaryTotalContribution = $MarchTertiaryTotalContribution + $tertiary_unit_accomplishment->MarchAccomplishment;
                                        $tertiary_unit_Marchchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                           
                            
                        </td>
                        <td>
                            {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->AprilAccomplishment }}
                            <br>
                            <?php
                                $AprilTertiaryTotalContribution = 0;
                                $tertiary_unit_Aprilchecker = null;
                                $TertiaryUnitAprilCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $AprilTertiaryTotalContribution = $AprilTertiaryTotalContribution + $tertiary_unit_accomplishment->AprilAccomplishment;
                                        $tertiary_unit_Aprilchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                           
                        </td>
                        <td>
                            {{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->MayAccomplishment }}
                            <br>
                            <?php
                                $MayTertiaryTotalContribution = 0;
                                $tertiary_unit_Maychecker = null;
                                $TertiaryUnitMayCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $MayTertiaryTotalContribution = $MayTertiaryTotalContribution + $tertiary_unit_accomplishment->MayAccomplishment;
                                        $tertiary_unit_Maychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->JuneAccomplishment }}
                            <br>
                            <?php
                                $JuneTertiaryTotalContribution = 0;
                                $tertiary_unit_Junechecker = null;
                                $TertiaryUnitJuneCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JuneTertiaryTotalContribution = $JuneTertiaryTotalContribution + $tertiary_unit_accomplishment->JuneAccomplishment;
                                        $tertiary_unit_Junechecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->JulyAccomplishment }}
                            <br>
                            <?php
                                $JulyTertiaryTotalContribution = 0;
                                $tertiary_unit_Julychecker = null;
                                $TertiaryUnitJulyCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $JulyTertiaryTotalContribution = $JulyTertiaryTotalContribution + $tertiary_unit_accomplishment->JulyAccomplishment;
                                        $tertiary_unit_Julychecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->AugustAccomplishment }}
                            <br>
                            <?php
                                $AugustTertiaryTotalContribution = 0;
                                $tertiary_unit_Augustchecker = null;
                                $TertiaryUnitAugustCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $AugustTertiaryTotalContribution = $AugustTertiaryTotalContribution + $tertiary_unit_accomplishment->AugustAccomplishment;
                                        $tertiary_unit_Augustchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                           
                        </td>
                        <td>
                            {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->SeptemberAccomplishment }}
                            <br>
                            <?php
                                $SeptemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Septemberchecker = null;
                                $TertiaryUnitSeptemberCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $SeptemberTertiaryTotalContribution = $SeptemberTertiaryTotalContribution + $tertiary_unit_accomplishment->SeptemberAccomplishment;
                                        $tertiary_unit_Septemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->OctoberAccomplishment }}
                            <br>
                            <?php
                                $OctoberTertiaryTotalContribution = 0;
                                $tertiary_unit_Octoberchecker = null;
                                $TertiaryUnitOctoberCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $OctoberTertiaryTotalContribution = $OctoberTertiaryTotalContribution + $tertiary_unit_accomplishment->OctoberAccomplishment;
                                        $tertiary_unit_Octoberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->NovemberAccomplishment }}
                            <br>
                            <?php
                                $NovemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Novemberchecker = null;
                                $TertiaryUnitNovemberCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $NovemberTertiaryTotalContribution = $NovemberTertiaryTotalContribution + $tertiary_unit_accomplishment->NovemberAccomplishment;
                                        $tertiary_unit_Novemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                            
                        </td>
                        <td>
                            {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ $accomplishment->tertiary_unit_accomplishment->DecemberAccomplishment }}
                            <br>
                            <?php
                                $DecemberTertiaryTotalContribution = 0;
                                $tertiary_unit_Decemberchecker = null;
                                $TertiaryUnitDecemberCounter = 0;
                            ?>
                            @foreach($accomplishments as $accomplishment)
                                @foreach($accomplishment->tertiary_unit_measure->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $DecemberTertiaryTotalContribution = $DecemberTertiaryTotalContribution + $tertiary_unit_accomplishment->DecemberAccomplishment;
                                        $tertiary_unit_Decemberchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            
                           
                        </td>
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->tertiary_unit_initiative->TertiaryUnitInitiativeContent }}
                        </td>
                        <td style="text-align: right;">
                            {{ round($accomplishment->tertiary_unit_funding->TertiaryUnitFundingEstimate, 2) }}
                        </td>
                        <td style="text-align: right;">
                            {{ round($accomplishment->tertiary_unit_funding->TertiaryUnitFundingActual, 2) }}
                        </td>
                        <td style="text-align: right;">
                            {{ round(($accomplishment->tertiary_unit_funding->TertiaryUnitFundingEstimate - $accomplishment->tertiary_unit_funding->TertiaryUnitFundingActual), 2) }}
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

            $maxid = TertiaryUnitAccomplishment::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)
                                        ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->max('updated_at');
            $maxid2 = TertiaryUnitOwner::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');
            $maxid3 = TertiaryUnitInitiative::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)
                                    ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->max('updated_at');
            $maxid4 = TertiaryUnitFunding::where('TertiaryUnitID','=',$tertiary_unit->TertiaryUnitID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');


            $updatedby = TertiaryUnitAccomplishment::where('updated_at','=',$maxid)
                ->with('user_tertiary_unit')
                ->with('user_tertiary_unit.rank')
                ->first();

            $updatedby2 = TertiaryUnitOwner::where('updated_at','=',$maxid2)
                ->with('user_tertiary_unit')
                ->with('user_tertiary_unit.rank')
                ->first(); 

            $updatedby3 = TertiaryUnitInitiative::where('updated_at','=',$maxid3)
                ->with('user_tertiary_unit')
                ->with('user_tertiary_unit.rank')
                ->first();

            $updatedby4 = TertiaryUnitFunding::where('updated_at','=',$maxid4)
                ->with('user_tertiary_unit')
                ->with('user_tertiary_unit.rank')
                ->first(); 

        //dd($updatedby);
    ?>
    <br>
    @if($checkAccomplishment != 0)
        <div>
            <i>
                Accomplishment last updated by: 
                <b>{{ $updatedby->user_tertiary_unit->rank->RankCode }} {{ $updatedby->user_tertiary_unit->UserTertiaryUnitLastName }}, {{ $updatedby->user_tertiary_unit->UserTertiaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Owner last updated by:  
                <b>{{ $updatedby2->user_tertiary_unit->rank->RankCode }} {{ $updatedby2->user_tertiary_unit->UserTertiaryUnitLastName }}, {{ $updatedby2->user_tertiary_unit->UserTertiaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby2->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby2->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Initiative last updated by:  
                <b>{{ $updatedby3->user_tertiary_unit->rank->RankCode }} {{ $updatedby3->user_tertiary_unit->UserTertiaryUnitLastName }}, {{ $updatedby3->user_tertiary_unit->UserTertiaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby3->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby3->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Funding last updated by:  
                <b>{{ $updatedby4->user_tertiary_unit->rank->RankCode }} {{ $updatedby4->user_tertiary_unit->UserTertiaryUnitLastName }}, {{ $updatedby4->user_tertiary_unit->UserTertiaryUnitFirstName }} {{ date('F d, Y', strtotime($updatedby4->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby4->updated_at)) }}</b>
            </i>

        </div>
    @endif
</body>