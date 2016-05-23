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

    $chief_id = Session::get('chief_user_id', 'default');
    $chief_user = UserChief::where('UserChiefID', '=', $chief_id)
                            ->first();

    $chief_id = Session::get('chief_user_id', 'default'); //get the UserChiefID stored in session.
    $chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief      
        
    $chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();
    $chief_objectives = ChiefObjective::all();
    $chief_measures = ChiefMeasure::with('chief')->where('ChiefID', '=', $chief_user->ChiefID)->get();

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
                                    ->get();

	foreach ($accomplishments as $accomplishment)
	{
		//dd($accomplishment);
	}
	//dd($accomplishments);	
	$logoPath = 'img/pnp_logo2.png';
	$chieflogoPath = 'uploads/chiefpictures/cropped/'.$chief->PicturePath;
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
    	top: 17px;
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
    </style>
</head>

<body>
	<img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 122px;">
	<img class="unitlogo" src="{{URL::asset($chieflogoPath)}}" style="height: 120px;width: 120px;">
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
    @if(count($accomplishments) > 0)
    	<table border="1">
        	<thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td width="53" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="65" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td rowspan="2">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="70" style="text-align: left;padding-left: 3px;">Name</td>
                    <td>LG</td>
                    <td>LD</td>
                    <td width="35">Jan</td>
                    <td width="35">Feb</td>
                    <td width="35">Mar</td>
                    <td width="35">Apr</td>
                    <td width="35">May</td>
                    <td width="35">Jun</td>
                    <td width="35">Jul</td>
                    <td width="35">Aug</td>
                    <td width="35">Sep</td>
                    <td width="35">Oct</td>
    				<td width="35">Nov</td>
    				<td width="35">Dec</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>	
        	</thead>
        	<tbody>
        		@foreach($accomplishments as $accomplishment)
        		<tr style="font-family: arial;">
        			<td style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->chief_measure->chief_objective->ChiefObjectiveName }}
        			</td>
        			<td  style="vertical-align: top;text-align: left;">
        				{{ $accomplishment->chief_measure->ChiefMeasureName }}
                        <br>
                        <div style="font-size: 9px;">Contributory/ies to this Measure</div> 
                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                            @foreach($contributor->staff_accomplishments as $contributory)
                                <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                <br>
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
        				{{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->JanuaryAccomplishment+$unitJanuaryContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->FebruaryAccomplishment+$unitFebruaryContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
    				</td>
        			<td>
        				{{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->MarchAccomplishment+$unitMarchContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->AprilAccomplishment+$unitAprilContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->MayAccomplishment+$unitMayContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->JuneAccomplishment+$unitJuneContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->JulyAccomplishment+$unitJulyContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->AugustAccomplishment+$unitAugustContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->SeptemberAccomplishment+$unitSeptemberContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->OctoberAccomplishment+$unitOctoberContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->NovemberAccomplishment+$unitNovemberContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
        			</td>
        			<td>
        				{{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
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
                                <br>
                                <normal>
                                    <b>+{{ round(($contributory->DecemberAccomplishment+$unitDecemberContribution), 2) }}</b> 
                                    <span class="label label-default">{{ $contributory->staff->StaffAbbreviation }}</span>
                                </normal>
                            @endforeach
                        @endforeach
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
    	</table>
    @else
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
</body>