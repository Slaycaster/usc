<?php
	
//Models
use App\StaffTarget;
use App\StaffMeasure;
use App\StaffObjective;
use App\Staff;
use App\UserStaff;
use App\StaffAccomplishment;
use App\StaffOwner;
use App\StaffInitiative;
use App\StaffFunding;

use App\UnitAccomplishment;

	$selectedYear = Session::get('year', 'default');
    $reportType = Session::get('reportType', 'default');	

    $staff_id = Session::get('staff_user_id', 'default');
    $staff_user = UserStaff::where('UserStaffID', '=', $staff_id)
                            ->first();

    $staff_id = Session::get('staff_user_id', 'default'); //get the UserstaffID stored in session.
    $staff = UserStaff::where('UserStaffID', '=', $staff_id)->select('StaffID')->first(); //Get the Unit of the chief
      
    $staff = Staff::where('StaffID', '=', $staff_user->StaffID)->first();
    $staff_objectives = StaffObjective::all();
    $staff_measures = StaffMeasure::with('staff')->where('StaffID', '=', $staff_user->StaffID)->get();
    
	
	$logoPath = 'img/pnp_logo2.png';
	$stafflogoPath = 'uploads/staffpictures/cropped/'.$staff->PicturePath;
    $tempObjective = '';

    $sortByObjective = DB::table('staff_objectives')
                        ->join('staff_measures', 'staff_objectives.StaffObjectiveID', '=', 'staff_measures.StaffObjectiveID')
                        ->where('staff_objectives.StaffID', '=', $staff->StaffID)
                        ->orderBy('staff_objectives.StaffObjectiveName', 'asc')
                        ->orderBy('staff_measures.StaffMeasureID' , 'asc')
                        ->get();//dd($staff->StaffID);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = StaffTarget::with('staff_measure')
                                    ->with('staff_measure.staff_objective')
                                    ->with('staff_measure.unit_measures.unit_accomplishments')
                                    ->with('staff_measure.unit_measures.unit_accomplishments.unit')
                                    ->with('staff_measure.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
                                    ->with('staff_measure.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
                                    ->with('staff_owner')
                                    ->with('staff_funding')
                                    ->with('staff_initiative')
                                    ->with('staff_accomplishment')
                                    ->with('user_staff')
                                    ->with('user_staff.rank')
                                    ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->where('StaffID', '=', $staff->StaffID)
                                    ->where('StaffMeasureID', '=', $measure->StaffMeasureID)
                                    ->get();
        if(count($accomplishments) != 0)
        {
            $checkAccomplishment = $checkAccomplishment + 1;
        }
    }
?>

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
    .label-gray 
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
	<img src="{{URL::asset($logoPath)}}" style="height: 155px;width: 122px;">
	<img class="unitlogo" src="{{URL::asset($stafflogoPath)}}" style="height: 120px;width: 120px;">
	<p style="text-align: center;">
		<normal style="font-size: 15px">Republic of the Philippines</normal>
		<br>
		<strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
		<br>
		<normal style="font-size: 15px">{{ $staff->StaffName }}</normal>
		<br>
		<normal style="font-size: 10px">usc.pulis.net</normal>
	</p>
	<p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $staff->StaffAbbreviation }} Scorecard for {{ $selectedYear }}</p>
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
                $accomplishments = StaffTarget::with('staff_measure')
                                    ->with('staff_measure.staff_objective')
                                    ->with('staff_measure.unit_measures.unit_accomplishments')
                                    ->with('staff_measure.unit_measures.unit_accomplishments.unit')
                                    ->with('staff_measure.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
                                    ->with('staff_measure.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
                                    ->with('staff_owner')
                                    ->with('staff_funding')
                                    ->with('staff_initiative')
                                    ->with('staff_accomplishment')
                                    ->with('user_staff')
                                    ->with('user_staff.rank')
                                    ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->where('StaffID', '=', $staff->StaffID)
                                    ->where('StaffMeasureID', '=', $measure->StaffMeasureID)
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
                        @if($tempObjective != $accomplishment->staff_measure->staff_objective->StaffObjectiveName)
                            <?php
                                $tempObjective = $accomplishment->staff_measure->staff_objective->StaffObjectiveName;
                            ?>
                            <td style="vertical-align: top;text-align: left;">
                                {{ $accomplishment->staff_measure->staff_objective->StaffObjectiveName }}
                            </td>
                        @else
                            <td></td>
                        @endif
            			<td style="vertical-align: top;text-align: left;">
            				{{ $accomplishment->staff_measure->StaffMeasureName }}
                            <br>
                            @if($accomplishment->staff_measure->ChiefMeasureID > 0)
                                <span class="labelc label-primary">Contributory to C, PNP</span>
                            @endif
                            <div style="font-size: 9px;font-style: italic;">Contributory/ies to this Measure</div>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <div style="font-size: 9px;">
                                        <span class="labelc label-gray">{{ $contributory->unit->UnitAbbreviation }}</span>
                                    </div>
                                @endforeach
                            @endforeach
            			</td>
            			@if($accomplishment->staff_measure->StaffMeasureType == 'LG')
                            <td style="background-color: #5cb85c;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #5cb85c;"></td>
                        @endif
            			<td style="vertical-align: top;text-align: left;">
            				{{ $accomplishment->staff_owner->StaffOwnerContent }}
            			</td>
            			<td>
            				{{ round(($accomplishment->JanuaryTarget + $accomplishment->FebruaryTarget + $accomplishment->MarchTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->staff_accomplishment->JanuaryAccomplishment + $accomplishment->staff_accomplishment->FebruaryAccomplishment + $accomplishment->staff_accomplishment->MarchAccomplishment), 2) }}
                            <?php
                                $totalFirstQuarterContribution = 0;
                                $unit_FirstQuarterchecker = null;
                                $unitFirstQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryFirstQuarterTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryFirstQuarterAccomplishment = 0;
                                            $tertiaryFirstQuarterAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryFirstQuarterAccomplishment = $secondaryFirstQuarterAccomplishment + $secondaryunitContributeAcc->JanuaryAccomplishment + $secondaryunitContributeAcc->FebruaryAccomplishment + $secondaryunitContributeAcc->MarchAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryFirstQuarterAccomplishment = $tertiaryFirstQuarterAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryFirstQuarterTotalAccomplishment = $secondaryFirstQuarterAccomplishment + $tertiaryFirstQuarterAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalFirstQuarterContribution = $secondaryFirstQuarterTotalAccomplishment + $contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment;
                                            $unit_FirstQuarterchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_FirstQuarterchecker != null && $totalFirstQuarterContribution != 0)
                                <b>+{{ round($totalFirstQuarterContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryFirstQuarterTotalAccomplishment = 0;
                                                $unitFirstQuarterCounter = $unitFirstQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryFirstQuarterAccomplishment = 0;
                                                    $tertiaryFirstQuarterAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryFirstQuarterAccomplishment = $secondaryFirstQuarterAccomplishment + $secondaryunitContributeAcc->JanuaryAccomplishment + $secondaryunitContributeAcc->FebruaryAccomplishment + $secondaryunitContributeAcc->MarchAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryFirstQuarterAccomplishment = $tertiaryFirstQuarterAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryFirstQuarterTotalAccomplishment = $secondaryFirstQuarterAccomplishment + $tertiaryFirstQuarterAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitFirstQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment + $secondaryFirstQuarterTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitFirstQuarterCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_FirstQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
            			</td>
                        <td>
                            {{ round(($accomplishment->AprilTarget + $accomplishment->MayTarget + $accomplishment->JuneTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->staff_accomplishment->AprilAccomplishment + $accomplishment->staff_accomplishment->MayAccomplishment + $accomplishment->staff_accomplishment->JuneAccomplishment), 2) }}
                            <?php
                                $totalSecondQuarterContribution = 0;
                                $unit_SecondQuarterchecker = null;
                                $unitSecondQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondarySecondQuarterTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondarySecondQuarterAccomplishment = 0;
                                            $tertiarySecondQuarterAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondarySecondQuarterAccomplishment = $secondarySecondQuarterAccomplishment + $secondaryunitContributeAcc->AprilAccomplishment + $secondaryunitContributeAcc->MayAccomplishment + $secondaryunitContributeAcc->JuneAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiarySecondQuarterAccomplishment = $tertiarySecondQuarterAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondarySecondQuarterTotalAccomplishment = $secondarySecondQuarterAccomplishment + $tertiarySecondQuarterAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalSecondQuarterContribution = $secondarySecondQuarterTotalAccomplishment + $contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment;
                                            $unit_SecondQuarterchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_SecondQuarterchecker != null && $totalSecondQuarterContribution != 0)
                                <b>+{{ round($totalSecondQuarterContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondarySecondQuarterTotalAccomplishment = 0;
                                                $unitSecondQuarterCounter = $unitSecondQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondarySecondQuarterAccomplishment = 0;
                                                    $tertiarySecondQuarterAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondarySecondQuarterAccomplishment = $secondarySecondQuarterAccomplishment + $secondaryunitContributeAcc->AprilAccomplishment + $secondaryunitContributeAcc->MayAccomplishment + $secondaryunitContributeAcc->JuneAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiarySecondQuarterAccomplishment = $tertiarySecondQuarterAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondarySecondQuarterTotalAccomplishment = $secondarySecondQuarterAccomplishment + $tertiarySecondQuarterAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitSecondQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment + $secondarySecondQuarterTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitSecondQuarterCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_SecondQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round(($accomplishment->JulyTarget + $accomplishment->AugustTarget + $accomplishment->SeptemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->staff_accomplishment->JulyAccomplishment + $accomplishment->staff_accomplishment->AugustAccomplishment + $accomplishment->staff_accomplishment->SeptemberAccomplishment), 2) }}
                            <?php
                                $totalThirdQuarterContribution = 0;
                                $unit_ThirdQuarterchecker = null;
                                $unitThirdQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryThirdQuarterTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryThirdQuarterAccomplishment = 0;
                                            $tertiaryThirdQuarterAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryThirdQuarterAccomplishment = $secondaryThirdQuarterAccomplishment + $secondaryunitContributeAcc->JulyAccomplishment + $secondaryunitContributeAcc->AugustAccomplishment + $secondaryunitContributeAcc->SeptemberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryThirdQuarterAccomplishment = $tertiaryThirdQuarterAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryThirdQuarterTotalAccomplishment = $secondaryThirdQuarterAccomplishment + $tertiaryThirdQuarterAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalThirdQuarterContribution = $secondaryThirdQuarterTotalAccomplishment + $contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment;
                                            $unit_ThirdQuarterchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_ThirdQuarterchecker != null && $totalThirdQuarterContribution != 0)
                                <b>+{{ round($totalThirdQuarterContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryThirdQuarterTotalAccomplishment = 0;
                                                $unitThirdQuarterCounter = $unitThirdQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryThirdQuarterAccomplishment = 0;
                                                    $tertiaryThirdQuarterAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryThirdQuarterAccomplishment = $secondaryThirdQuarterAccomplishment + $secondaryunitContributeAcc->JulyAccomplishment + $secondaryunitContributeAcc->AugustAccomplishment + $secondaryunitContributeAcc->SeptemberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryThirdQuarterAccomplishment = $tertiaryThirdQuarterAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryThirdQuarterTotalAccomplishment = $secondaryThirdQuarterAccomplishment + $tertiaryThirdQuarterAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitThirdQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment + $secondaryThirdQuarterTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitThirdQuarterCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_ThirdQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round(($accomplishment->OctoberTarget + $accomplishment->NovemberTarget + $accomplishment->DecemberTarget), 2) }}<b>/ </b>
                            <br>
                            {{ round(($accomplishment->staff_accomplishment->OctoberAccomplishment + $accomplishment->staff_accomplishment->NovemberAccomplishment + $accomplishment->staff_accomplishment->DecemberAccomplishment), 2) }}
                            <?php
                                $totalFourthQuarterContribution = 0;
                                $unit_FourthQuarterchecker = null;
                                $unitFourthQuarterCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryFourthQuarterTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryFourthQuarterAccomplishment = 0;
                                            $tertiaryFourthQuarterAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryFourthQuarterAccomplishment = $secondaryFourthQuarterAccomplishment + $secondaryunitContributeAcc->OctoberAccomplishment + $secondaryunitContributeAcc->NovemberAccomplishment + $secondaryunitContributeAcc->DecemberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryFourthQuarterAccomplishment = $tertiaryFourthQuarterAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryFourthQuarterTotalAccomplishment = $secondaryFourthQuarterAccomplishment + $tertiaryFourthQuarterAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalFourthQuarterContribution = $secondaryFourthQuarterTotalAccomplishment + $contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment;
                                            $unit_FourthQuarterchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_FourthQuarterchecker != null && $totalFourthQuarterContribution != 0)
                                <b>+{{ round($totalFourthQuarterContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryFourthQuarterTotalAccomplishment = 0;
                                                $unitFourthQuarterCounter = $unitFourthQuarterCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryFourthQuarterAccomplishment = 0;
                                                    $tertiaryFourthQuarterAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryFourthQuarterAccomplishment = $secondaryFourthQuarterAccomplishment + $secondaryunitContributeAcc->OctoberAccomplishment + $secondaryunitContributeAcc->NovemberAccomplishment + $secondaryunitContributeAcc->DecemberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryFourthQuarterAccomplishment = $tertiaryFourthQuarterAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryFourthQuarterTotalAccomplishment = $secondaryFourthQuarterAccomplishment + $tertiaryFourthQuarterAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitFourthQuarterCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment + $secondaryFourthQuarterTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitFourthQuarterCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_FourthQuarterchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>

                        
            			<td style="vertical-align: top;text-align: left;">
            				{{ $accomplishment->staff_initiative->StaffInitiativeContent }}
            			</td>
            			<td style="text-align: right;">
            				{{ round($accomplishment->staff_funding->StaffFundingEstimate, 2) }}
            			</td>
            			<td style="text-align: right;">
            				{{ round($accomplishment->staff_funding->StaffFundingActual, 2) }}
            			</td>
            			<td style="text-align: right;">
            				{{ round(($accomplishment->staff_funding->StaffFundingEstimate - $accomplishment->staff_funding->StaffFundingActual), 2) }}
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

        $maxid = StaffAccomplishment::where('StaffID','=',$staff->StaffID)
                                    ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->max('updated_at');
        $maxid2 = StaffOwner::where('StaffID','=',$staff->StaffID)
                            ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                            ->max('updated_at');
        $maxid3 = StaffInitiative::where('StaffID','=',$staff->StaffID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');
        $maxid4 = StaffFunding::where('StaffID','=',$staff->StaffID)
                                ->whereBetween('updated_at', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                ->max('updated_at');


        $updatedby = StaffAccomplishment::where('updated_at','=',$maxid)
                ->with('user_staff')
                ->with('user_staff.rank')
                ->first();

        $updatedby2 = StaffOwner::where('updated_at','=',$maxid2)
                ->with('user_staff')
                ->with('user_staff.rank')
                ->first(); 

        $updatedby3 = StaffInitiative::where('updated_at','=',$maxid3)
                ->with('user_staff')
                ->with('user_staff.rank')
                ->first();

        $updatedby4 = StaffFunding::where('updated_at','=',$maxid4)
                ->with('user_staff')
                ->with('user_staff.rank')
                ->first(); 

        //dd($updatedby);
    ?>
    <br>
    @if($checkAccomplishment != 0)
        <div>
            <i>
                Accomplishment last updated by: 
                <b>{{ $updatedby->user_staff->rank->RankCode }} {{ $updatedby->user_staff->UserStaffLastName }}, {{ $updatedby->user_staff->UserStaffFirstName }} {{ date('F d, Y', strtotime($updatedby->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Owner last updated by:  
                <b>{{ $updatedby2->user_staff->rank->RankCode }} {{ $updatedby2->user_staff->UserStaffLastName }}, {{ $updatedby2->user_staff->UserStaffFirstName }} {{ date('F d, Y', strtotime($updatedby2->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby2->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Initiative last updated by:  
                <b>{{ $updatedby3->user_staff->rank->RankCode }} {{ $updatedby3->user_staff->UserStaffLastName }}, {{ $updatedby3->user_staff->UserStaffFirstName }} {{ date('F d, Y', strtotime($updatedby3->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby3->updated_at)) }}</b>
            </i>
            <br>
            <i>
                Funding last updated by:  
                <b>{{ $updatedby4->user_staff->rank->RankCode }} {{ $updatedby4->user_staff->UserStaffLastName }}, {{ $updatedby4->user_staff->UserStaffFirstName }} {{ date('F d, Y', strtotime($updatedby4->updated_at)) }} at {{ date('g:i:s A', strtotime($updatedby4->updated_at)) }}</b>
            </i>

        </div>
    @endif
</body>