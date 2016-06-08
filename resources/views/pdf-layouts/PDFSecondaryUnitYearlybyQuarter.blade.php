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

 	$secondary_unit_id = Session::get('secondary_user_id', 'default');
    $user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
                ->with('secondary_unit')
                ->first();//dd($user);
    $secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->first();

    $user = UserSecondaryUnit::where('UserSecondaryUnitID', $secondary_unit_id)
                    ->first();

	$logoPath = 'img/pnp_logo2.png';
	$secondaryunitlogoPath = 'uploads/secondaryunitpictures/cropped/'.$secondary_unit->PicturePath;
    $tempObjective = '';

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
                        <td>{{--FIRST QUARTER--}}
                            {{ round(($accomplishment->JanuaryTarget + $accomplishment->FebruaryTarget + $accomplishment->MarchTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->secondary_unit_accomplishment->JanuaryAccomplishment + $accomplishment->secondary_unit_accomplishment->FebruaryAccomplishment + $accomplishment->secondary_unit_accomplishment->MarchAccomplishment), 2) }}
                            <br>
                            <?php
                                $FirstQuarterTertiaryTotalContribution = 0;
                                $tertiary_unit_FirstQuarterchecker = null;
                                $secondaryUnitFirstQuarterCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $FirstQuarterTertiaryTotalContribution = $FirstQuarterTertiaryTotalContribution + $tertiary_unit_accomplishment->JanuaryAccomplishment + $tertiary_unit_accomplishment->FebruaryAccomplishment + $tertiary_unit_accomplishment->MarchAccomplishment;
                                        $tertiary_unit_FirstQuarterchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_FirstQuarterchecker != null)
                                <b>+{{ $FirstQuarterTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitFirstQuarterCounter = $secondaryUnitFirstQuarterCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitFirstQuarterCounter == 1)(@endif{{ $tertiary_unit_accomplishment->JanuaryAccomplishment + $tertiary_unit_accomplishment->FebruaryAccomplishment + $tertiary_unit_accomplishment->MarchAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_FirstQuarterchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>{{--SECOND QUARTER--}}
                            {{ round(($accomplishment->AprilTarget + $accomplishment->MayTarget + $accomplishment->JuneTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->secondary_unit_accomplishment->AprilAccomplishment + $accomplishment->secondary_unit_accomplishment->MayAccomplishment + $accomplishment->secondary_unit_accomplishment->JuneAccomplishment), 2) }}
                            <br>
                            <?php
                                $SecondQuarterTertiaryTotalContribution = 0;
                                $tertiary_unit_SecondQuarterchecker = null;
                                $secondaryUnitSecondQuarterCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $SecondQuarterTertiaryTotalContribution = $SecondQuarterTertiaryTotalContribution + $tertiary_unit_accomplishment->AprilAccomplishment + $tertiary_unit_accomplishment->MayAccomplishment + $tertiary_unit_accomplishment->JuneAccomplishment;
                                        $tertiary_unit_SecondQuarterchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_SecondQuarterchecker != null)
                                <b>+{{ $SecondQuarterTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitSecondQuarterCounter = $secondaryUnitSecondQuarterCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitSecondQuarterCounter == 1)(@endif{{ $tertiary_unit_accomplishment->AprilAccomplishment + $tertiary_unit_accomplishment->MayAccomplishment + $tertiary_unit_accomplishment->JuneAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_SecondQuarterchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>{{--THIRD QUARTER--}}
                            {{ round(($accomplishment->JulyTarget + $accomplishment->AugustTarget + $accomplishment->SeptemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->secondary_unit_accomplishment->JulyAccomplishment + $accomplishment->secondary_unit_accomplishment->AugustAccomplishment + $accomplishment->secondary_unit_accomplishment->SeptemberAccomplishment), 2) }}
                            <br>
                            <?php
                                $ThirdQuarterTertiaryTotalContribution = 0;
                                $tertiary_unit_ThirdQuarterchecker = null;
                                $secondaryUnitThirdQuarterCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $ThirdQuarterTertiaryTotalContribution = $ThirdQuarterTertiaryTotalContribution + $tertiary_unit_accomplishment->JulyAccomplishment + $tertiary_unit_accomplishment->AugustAccomplishment + $tertiary_unit_accomplishment->SeptemberAccomplishment;
                                        $tertiary_unit_ThirdQuarterchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_ThirdQuarterchecker != null)
                                <b>+{{ $ThirdQuarterTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitThirdQuarterCounter = $secondaryUnitThirdQuarterCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitThirdQuarterCounter == 1)(@endif{{ $tertiary_unit_accomplishment->JulyAccomplishment + $tertiary_unit_accomplishment->AugustAccomplishment + $tertiary_unit_accomplishment->SeptemberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_ThirdQuarterchecker != null)
                                    )
                                @endif
                            @endif
                        </td>
                        <td>{{--FOURTH QUARTER--}}
                            {{ round(($accomplishment->OctoberTarget + $accomplishment->NovemberTarget + $accomplishment->DecemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->secondary_unit_accomplishment->OctoberAccomplishment + $accomplishment->secondary_unit_accomplishment->NovemberAccomplishment + $accomplishment->secondary_unit_accomplishment->DecemberAccomplishment), 2) }}
                            <br>
                            <?php
                                $FourthQuarterTertiaryTotalContribution = 0;
                                $tertiary_unit_FourthQuarterchecker = null;
                                $secondaryUnitFourthQuarterCounter = 0;
                            ?>
                            @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                    <?php
                                        $FourthQuarterTertiaryTotalContribution = $FourthQuarterTertiaryTotalContribution + $tertiary_unit_accomplishment->OctoberAccomplishment + $tertiary_unit_accomplishment->NovemberAccomplishment + $tertiary_unit_accomplishment->DecemberAccomplishment;
                                        $tertiary_unit_FourthQuarterchecker = $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation;
                                    ?>
                                @endforeach
                            @endforeach
                            @if($tertiary_unit_FourthQuarterchecker != null)
                                <b>+{{ $FourthQuarterTertiaryTotalContribution }}</b>
                            @endif
                            @if($reportType == 'breakdown')
                                <br>
                                @foreach($accomplishment->secondary_unit_measure->tertiary_unit_measures as $tertiary_contributions)
                                    @foreach($tertiary_contributions->tertiary_unit_accomplishments as $tertiary_unit_accomplishment)
                                        <?php
                                            $secondaryUnitFourthQuarterCounter = $secondaryUnitFourthQuarterCounter + 1;
                                        ?>
                                        <normal>
                                            @if($secondaryUnitFourthQuarterCounter == 1)(@endif{{ $tertiary_unit_accomplishment->OctoberAccomplishment + $tertiary_unit_accomplishment->NovemberAccomplishment + $tertiary_unit_accomplishment->DecemberAccomplishment }}
                                            <span class="label label-default">{{ $tertiary_unit_accomplishment->tertiary_unit->TertiaryUnitAbbreviation }}</span>
                                        <normal>
                                    @endforeach
                                @endforeach
                                @if($tertiary_unit_FourthQuarterchecker != null)
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