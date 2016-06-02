<?php
	
//Models
use App\ChiefTarget;
use App\ChiefMeasure;
use App\ChiefObjective;
use App\Chief;
use App\UserChief;
use App\ChiefAccomplishment;
use App\ChiefOwner;
use App\ChiefInitiative;
use App\ChiefFunding;

use App\StaffAccomplishment;


	$selectedYear = Session::get('year', 'default');
    $selectedQuarter = Session::get('quarter', 'default');	

    $chief_id = Session::get('chief_user_id', 'default'); //get the UserChiefID stored in session.
    $chief_user = UserChief::where('UserChiefID', '=', $chief_id)
                            ->first();

    $chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief         
    $chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();

	$logoPath = 'img/pnp_logo2.png';
	$chieflogoPath = 'uploads/chiefpictures/cropped/'.$chief->PicturePath;
    $tempObjective = '';



    $sortByObjective = DB::table('chief_objectives')
                        ->join('chief_measures', 'chief_objectives.ChiefObjectiveID', '=', 'chief_measures.ChiefObjectiveID')
                        ->where('chief_objectives.ChiefID', '=', $chief_id)
                        ->orderBy('chief_objectives.ChiefObjectiveName', 'asc')
                        ->get();
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = ChiefTarget::with('chief_measure')
                                        ->with('chief_measure.chief_objective')
                                        ->with('chief_measure.staff_measures.staff_accomplishments')
                                        ->with('chief_measure.staff_measures.staff_accomplishments.staff')
                                        ->with('chief_measure.staff_measures.unit_measures.unit_accomplishments')
                                        ->with('chief_accomplishment')
                                        ->with('chief_owner')
                                        ->with('chief_initiative')
                                        ->with('chief_funding')
                                        ->with('user_chief')
                                        ->with('user_chief.rank')
                                        ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->where('ChiefID', '=', $chief_user->ChiefID)
                                        ->where('ChiefMeasureID', '=', $measure->ChiefMeasureID)
                                        ->get();
        if(count($accomplishments) != 0)
        {
            $checkAccomplishment = $checkAccomplishment + 1;
        }
    }
    //dd($sortByObjective);
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
	.unitlogo
	{
    	position: absolute;
    	left: 960px;
    	top: 16px;
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
    .footer 
    {
        width: 100%;
        text-align: right;
        font-size: 10px;
        position: fixed;
        bottom: 0px;
        counter-increment:pages;
    }
    .pagenum:before 
    {
        content: "Page " counter(page);
    }
    </style>
</head>

<body>
    {{-- <div class="footer">
        <span class="pagenum"></span>
    </div> --}}
    <img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 122px;">
    @if($chief->ChiefAbbreviation != "C, PNP")
        <img class="unitlogo" src="{{URL::asset($chieflogoPath)}}" style="height: 120px;width: 120px;">
    @endif
    <p style="text-align: center;">
        <normal style="font-size: 15px">Republic of the Philippines</normal>
        <br>
        <strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
        <br>
        <normal style="font-size: 15px">{{ $chief->ChiefName }}</normal>
        <br>
        <normal style="font-size: 10px">usc.pulis.net</normal>
    </p>
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $chief->ChiefAbbreviation }} KPI for Q{{ $selectedQuarter }} {{ $selectedYear }}</p>
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
                $accomplishments = ChiefTarget::with('chief_measure')
                                                ->with('chief_measure.chief_objective')
                                                ->with('chief_measure.staff_measures.staff_accomplishments')
                                                ->with('chief_measure.staff_measures.staff_accomplishments.staff')
                                                ->with('chief_measure.staff_measures.unit_measures.unit_accomplishments')
                                                ->with('chief_accomplishment')
                                                ->with('chief_owner')
                                                ->with('chief_initiative')
                                                ->with('chief_funding')
                                                ->with('user_chief')
                                                ->with('user_chief.rank')
                                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                                ->where('ChiefID', '=', $chief_user->ChiefID)
                                                ->where('ChiefMeasureID', '=', $measure->ChiefMeasureID)
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
                            {{ $accomplishment->chief_measure->ChiefMeasureName }}
                            <br>
                            <div style="font-size: 9px;">Contributory/ies to this Measure</div> 
                            @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                @foreach($contributor->staff_accomplishments as $contributory)
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                @endforeach
                            @endforeach
                        </td>
                        @if($accomplishment->chief_measure->ChiefMeasureType == 'LG')
                            <td style="background-color: #5cb85c;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #5cb85c;"></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->chief_measure->ChiefMeasureFormula }}
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
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJanuaryContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitJanuaryContribution = $unitContributeAcc->JanuaryAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalJanuaryContribution = $totalJanuaryContribution + $contributory->JanuaryAccomplishment+$unitJanuaryContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalJanuaryContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->JanuaryTarget - $totalJanuaryContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJanuaryContribution;
                                    $overallTarget = $overallTarget + $accomplishment->JanuaryTarget;
                                    $JanuaryTarget = $accomplishment->JanuaryTarget;
                                    $JanuaryPerformance = round(($totalJanuaryContribution / $JanuaryTarget) * 100, 2);
                                ?>
                                {{ $JanuaryPerformance }}%
                            </td>
                            {{-- FEBRUARY --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalFebruaryContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitFebruaryContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitFebruaryContribution = $unitContributeAcc->FebruaryAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalFebruaryContribution = $totalFebruaryContribution + $contributory->FebruaryAccomplishment+$unitFebruaryContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalFebruaryContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->FebruaryTarget - $totalFebruaryContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalFebruaryContribution;
                                    $overallTarget = $overallTarget + $accomplishment->FebruaryTarget;
                                    $FebruaryTarget = $accomplishment->FebruaryTarget;
                                    $FebruaryPerformance = round(($totalFebruaryContribution / $FebruaryTarget) * 100, 2);
                                ?>
                                {{ $FebruaryPerformance }}%
                            </td>
                            {{-- MARCH --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMarchContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitMarchContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitMarchContribution = $unitContributeAcc->MarchAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalMarchContribution = $totalMarchContribution + $contributory->MarchAccomplishment+$unitMarchContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalMarchContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->MarchTarget - $totalMarchContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalMarchContribution;
                                    $overallTarget = $overallTarget + $accomplishment->MarchTarget;
                                    $MarchTarget = $accomplishment->MarchTarget;
                                    $MarchPerformance = round(($totalMarchContribution / $MarchTarget) * 100, 2);
                                ?>
                                {{ $MarchPerformance }}%
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
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitAprilContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitAprilContribution = $unitContributeAcc->AprilAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalAprilContribution = $totalAprilContribution + $contributory->AprilAccomplishment+$unitAprilContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalAprilContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->AprilTarget - $totalAprilContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalAprilContribution;
                                    $overallTarget = $overallTarget + $accomplishment->AprilTarget;
                                    $AprilTarget = $accomplishment->AprilTarget;
                                    $AprilPerformance = round(($totalAprilContribution / $AprilTarget) * 100, 2);
                                ?>
                                {{ $AprilPerformance }}%
                            </td>
                            {{-- MAY --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMayContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitMayContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitMayContribution = $unitContributeAcc->MayAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalMayContribution = $totalMayContribution + $contributory->MayAccomplishment+$unitMayContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalMayContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->MayTarget - $totalMayContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalMayContribution;
                                    $overallTarget = $overallTarget + $accomplishment->MayTarget;
                                    $MayTarget = $accomplishment->MayTarget;
                                    $MayPerformance = round(($totalMayContribution / $MayTarget) * 100, 2);
                                ?>
                                {{ $MayPerformance }}%
                            </td>
                            {{-- JUNE --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJuneContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJuneContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitJuneContribution = $unitContributeAcc->JuneAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalJuneContribution = $totalJuneContribution + $contributory->JuneAccomplishment+$unitJuneContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalJuneContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->JuneTarget - $totalJuneContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJuneContribution;
                                    $overallTarget = $overallTarget + $accomplishment->JuneTarget;
                                    $JuneTarget = $accomplishment->JuneTarget;
                                    $JunePerformance = round(($totalJuneContribution / $JuneTarget) * 100, 2);
                                ?>
                                {{ $JunePerformance }}%
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
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJulyContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitJulyContribution = $unitContributeAcc->JulyAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalJulyContribution = $totalJulyContribution + $contributory->JulyAccomplishment+$unitJulyContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalJulyContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->JulyTarget - $totalJulyContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalJulyContribution;
                                    $overallTarget = $overallTarget + $accomplishment->JulyTarget;
                                    $JulyTarget = $accomplishment->JulyTarget;
                                    $JulyPerformance = round(($totalJulyContribution / $JulyTarget) * 100, 2);
                                ?>
                                {{ $JulyPerformance }}%
                            </td>
                            {{-- AUGUST --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalAugustContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitAugustContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitAugustContribution = $unitContributeAcc->AugustAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalAugustContribution = $totalAugustContribution + $contributory->AugustAccomplishment+$unitAugustContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalAugustContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->AugustTarget - $totalAugustContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalAugustContribution;
                                    $overallTarget = $overallTarget + $accomplishment->AugustTarget;
                                    $AugustTarget = $accomplishment->AugustTarget;
                                    $AugustPerformance = round(($totalAugustContribution / $AugustTarget) * 100, 2);
                                ?>
                                {{ $AugustPerformance }}%
                            </td>
                            {{-- SEPTEMBER --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalSeptemberContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitSeptemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitSeptemberContribution = $unitContributeAcc->SeptemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalSeptemberContribution = $totalSeptemberContribution + $contributory->SeptemberAccomplishment+$unitSeptemberContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalSeptemberContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->SeptemberTarget - $totalSeptemberContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalSeptemberContribution;
                                    $overallTarget = $overallTarget + $accomplishment->SeptemberTarget;
                                    $SeptemberTarget = $accomplishment->SeptemberTarget;
                                    $SeptemberPerformance = round(($totalSeptemberContribution / $SeptemberTarget) * 100, 2);
                                ?>
                                {{ $SeptemberPerformance }}%
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
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitOctoberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitOctoberContribution = $unitContributeAcc->OctoberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalOctoberContribution = $totalOctoberContribution + $contributory->OctoberAccomplishment+$unitOctoberContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalOctoberContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->OctoberTarget - $totalOctoberContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalOctoberContribution;
                                    $overallTarget = $overallTarget + $accomplishment->OctoberTarget;
                                    $OctoberTarget = $accomplishment->OctoberTarget;
                                    $OctoberPerformance = round(($totalOctoberContribution / $OctoberTarget) * 100, 2);
                                ?>
                                {{ $OctoberPerformance }}%
                            </td>
                            {{-- NOVEMBER --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalNovemberContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitNovemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitNovemberContribution = $unitContributeAcc->NovemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalNovemberContribution = $totalNovemberContribution + $contributory->NovemberAccomplishment+$unitNovemberContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalNovemberContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->NovemberTarget - $totalNovemberContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalNovemberContribution;
                                    $overallTarget = $overallTarget + $accomplishment->NovemberTarget;
                                    $NovemberTarget = $accomplishment->NovemberTarget;
                                    $NovemberPerformance = round(($totalNovemberContribution / $NovemberTarget) * 100, 2);
                                ?>
                                {{ $NovemberPerformance }}%
                            </td>
                            {{-- DECEMBER --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalDecemberContribution = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitDecemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $unitDecemberContribution = $unitContributeAcc->DecemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach 
                                            <?php
                                                $totalDecemberContribution = $totalDecemberContribution + $contributory->DecemberAccomplishment+$unitDecemberContribution;
                                            ?> 
                                    @endforeach
                                @endforeach
                                {{ round($totalDecemberContribution, 2) }}
                            </td>
                            <td>
                                {{ round(($accomplishment->DecemberTarget - $totalDecemberContribution), 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $totalDecemberContribution;
                                    $overallTarget = $overallTarget + $accomplishment->DecemberTarget;
                                    $DecemberTarget = $accomplishment->DecemberTarget;
                                    $DecemberPerformance = round(($totalDecemberContribution / $DecemberTarget) * 100, 2);
                                ?>
                                {{ $DecemberPerformance }}%
                            </td>   
                        @endif
                        @if($accomplishment->chief_measure->ChiefMeasureFormula == 'Summation')
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
                                <b>{{ round($overallAccomplishment-$overallTarget-$overallTarget, 2) }}</b>
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