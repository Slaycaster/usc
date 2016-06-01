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
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $chief->ChiefAbbreviation }} Scorecard for {{ $selectedYear }}</p>
    <table border="1">
        @if(count($accomplishments) != 0)
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
            ?>
            <tbody>
                @foreach($accomplishments as $accomplishment)
                    <tr style="font-family: arial;">
                            @if($tempObjective != $accomplishment->chief_measure->chief_objective->ChiefObjectiveName)
                                <?php
                                    $tempObjective = $accomplishment->chief_measure->chief_objective->ChiefObjectiveName;
                                ?>
                                <td style="vertical-align: top;text-align: left;">
                                    {{ $accomplishment->chief_measure->chief_objective->ChiefObjectiveName }}
                                </td>
                            @else
                                <td></td>
                            @endif
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
                    			{{ $accomplishment->chief_owner->ChiefOwnerContent }}
                    		</td>
                    		<td>
                    			{{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitJanuaryCounter = 0;
                                ?>
                                @if($totalJanuaryContribution != 0)
                                    <b>{{ $totalJanuaryContribution }}</b>
                                @endif
                    		</td>
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitFebruaryCounter = 0;
                                ?>
                                @if($totalFebruaryContribution != 0)
                                    <b>{{ $totalFebruaryContribution }}</b>
                                @endif
                            </td>
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitMarchCounter = 0;
                                ?>
                                @if($totalMarchContribution != 0)
                                    <b>{{ $totalMarchContribution }}</b>
                                @endif
                            </td>
                            <td>
                                {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitAprilCounter = 0;
                                ?>
                                @if($totalAprilContribution != 0)
                                    <b>{{ $totalAprilContribution }}</b>
                                @endif
                            </td>
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitMayCounter = 0;
                                ?>
                                @if($totalMayContribution != 0)
                                    <b>{{ $totalMayContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitJuneCounter = 0;
                                ?>
                                @if($totalJuneContribution != 0)
                                    <b>{{ $totalJuneContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitJulyCounter = 0;
                                ?>
                                @if($totalJulyContribution != 0)
                                    <b>{{ $totalJulyContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitAugustCounter = 0;
                                ?>
                                @if($totalAugustContribution != 0)
                                    <b>{{ $totalAugustContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitSeptemberCounter = 0;
                                ?>
                                @if($totalSeptemberContribution != 0)
                                    <b>{{ $totalSeptemberContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitOctoberCounter = 0;
                                ?>
                                @if($totalOctoberContribution != 0)
                                    <b>{{ $totalOctoberContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitNovemberCounter = 0;
                                ?>
                                @if($totalNovemberContribution != 0)
                                    <b>{{ $totalNovemberContribution }}</b>
                                @endif
                            </td>
                             <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b><br>
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
                                <?php
                                    $unitDecemberCounter = 0;
                                ?>
                                @if($totalDecemberContribution != 0)
                                    <b>{{ $totalDecemberContribution }}</b>
                                @endif
                            </td>
                    		<td  style="vertical-align: top;text-align: left;">
                    			{{ $accomplishment->chief_initiative->ChiefInitiativeContent }}
                    		</td>
                    		<td style="text-align: right;">
                    			{{ round($accomplishment->chief_funding->ChiefFundingEstimate, 2) }}
                    		</td>
                    		<td style="text-align: right;">
                    			{{ round($accomplishment->chief_funding->ChiefFundingActual, 2) }}
                    		</td>
                    		<td style="text-align: right;">
                    			{{ round(($accomplishment->chief_funding->ChiefFundingEstimate - $accomplishment->chief_funding->ChiefFundingActual), 2) }}
                    		</td>
                    </tr>
                @endforeach
            </tbody>
        @endforeach
    </table>
    @if(count($accomplishments) == 0)
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
</body>