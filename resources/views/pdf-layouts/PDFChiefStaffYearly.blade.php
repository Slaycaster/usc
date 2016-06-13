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
    	
    $staff_id = Session::get('staff_id', 'default');

    $staff = Staff::where('StaffID', '=', $staff_id)->first();
    	
	$logoPath = 'img/pnp_logo2.png';
	$stafflogoPath = 'uploads/staffpictures/cropped/'.$staff->PicturePath;
    $tempObjective = '';

    $sortByObjective = DB::table('staff_objectives')
                        ->join('staff_measures', 'staff_objectives.StaffObjectiveID', '=', 'staff_measures.StaffObjectiveID')
                        ->where('staff_objectives.StaffID', '=', $staff_id)
                        ->orderBy('staff_objectives.StaffObjectiveName', 'asc')
                        ->orderBy('staff_measures.StaffMeasureID' , 'asc')
                        ->get();//dd($sortByObjective);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = StaffTarget::with('staff_measure')
                                        ->with('staff_measure.staff_objective')
                                        ->with('staff_measure.unit_measures.unit_accomplishments')
                                        ->with('staff_measure.unit_measures.unit_accomplishments.unit')
                                        ->with('staff_owner')
                                        ->with('staff_funding')
                                        ->with('staff_initiative')
                                        ->with('staff_accomplishment')
                                        ->with('user_staff')
                                        ->with('user_staff.rank')
                                        ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                        ->where('StaffID', '=', $staff_id)
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
            <thead style="font-weight: bold;font-family: arial,helvetica;">
                <tr>
                    <td width="53" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="68" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td width="65" rowspan="2" style="text-align: left;padding-left: 3px;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="70" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="33">Jan</td>
                    <td width="33">Feb</td>
                    <td width="33">Mar</td>
                    <td width="33">Apr</td>
                    <td width="33">May</td>
                    <td width="33">Jun</td>
                    <td width="33">Jul</td>
                    <td width="33">Aug</td>
                    <td width="33">Sep</td>
                    <td width="33">Oct</td>
                    <td width="33">Nov</td>
                    <td width="33">Dec</td>
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
                                    ->where('StaffID', '=', $staff_id)
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
                            {{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->JanuaryAccomplishment, 2) }}
                            <?php
                                $totalJanuaryContribution = 0;
                                $unit_Januarychecker = null;
                                $unitJanuaryCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryJanuaryTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryJanuaryAccomplishment = 0;
                                            $tertiaryJanuaryAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryJanuaryAccomplishment = $secondaryJanuaryAccomplishment + $secondaryunitContributeAcc->JanuaryAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryJanuaryAccomplishment = $tertiaryJanuaryAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryJanuaryTotalAccomplishment = $secondaryJanuaryAccomplishment + $tertiaryJanuaryAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalJanuaryContribution = $contributory->JanuaryAccomplishment + $secondaryJanuaryTotalAccomplishment;
                                            $unit_Januarychecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Januarychecker != null && $totalJanuaryContribution != 0)
                                <b>+{{ round($totalJanuaryContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryJanuaryTotalAccomplishment = 0;
                                                $unitJanuaryCounter = $unitJanuaryCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryJanuaryAccomplishment = 0;
                                                    $tertiaryJanuaryAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryJanuaryAccomplishment = $secondaryJanuaryAccomplishment + $secondaryunitContributeAcc->JanuaryAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryJanuaryAccomplishment = $tertiaryJanuaryAccomplishment + $tertiaryunitContributeAcc->JanuaryAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryJanuaryTotalAccomplishment = $secondaryJanuaryAccomplishment + $tertiaryJanuaryAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitJanuaryCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JanuaryAccomplishment + $secondaryJanuaryTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitJanuaryCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Januarychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->FebruaryAccomplishment, 2) }}
                            <?php
                                $totalFebruaryContribution = 0;
                                $unit_Februarychecker = null;
                                $unitFebruaryCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryFebruaryTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryFebruaryAccomplishment = 0;
                                            $tertiaryFebruaryAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryFebruaryAccomplishment = $secondaryFebruaryAccomplishment + $secondaryunitContributeAcc->FebruaryAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryFebruaryAccomplishment = $tertiaryFebruaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryFebruaryTotalAccomplishment = $secondaryFebruaryAccomplishment + $tertiaryFebruaryAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalFebruaryContribution = $contributory->FebruaryAccomplishment + $secondaryFebruaryTotalAccomplishment;
                                            $unit_Februarychecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Februarychecker != null && $totalFebruaryContribution != 0)
                                <b>+{{ round($totalFebruaryContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryFebruaryTotalAccomplishment = 0;
                                                $unitFebruaryCounter = $unitFebruaryCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryFebruaryAccomplishment = 0;
                                                    $tertiaryFebruaryAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryFebruaryAccomplishment = $secondaryFebruaryAccomplishment + $secondaryunitContributeAcc->FebruaryAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryFebruaryAccomplishment = $tertiaryFebruaryAccomplishment + $tertiaryunitContributeAcc->FebruaryAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryFebruaryTotalAccomplishment = $secondaryFebruaryAccomplishment + $tertiaryFebruaryAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitFebruaryCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->FebruaryAccomplishment + $secondaryFebruaryTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitFebruaryCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Februarychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->MarchAccomplishment, 2) }}
                            <?php
                                $totalMarchContribution = 0;
                                $unit_Marchchecker = null;
                                $unitMarchCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryMarchTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryMarchAccomplishment = 0;
                                            $tertiaryMarchAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryMarchAccomplishment = $secondaryMarchAccomplishment + $secondaryunitContributeAcc->MarchAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryMarchAccomplishment = $tertiaryMarchAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryMarchTotalAccomplishment = $secondaryMarchAccomplishment + $tertiaryMarchAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalMarchContribution = $contributory->MarchAccomplishment + $secondaryMarchTotalAccomplishment;
                                            $unit_Marchchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Marchchecker != null && $totalMarchContribution != 0)
                                <b>+{{ round($totalMarchContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryMarchTotalAccomplishment = 0;
                                                $unitMarchCounter = $unitMarchCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryMarchAccomplishment = 0;
                                                    $tertiaryMarchAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryMarchAccomplishment = $secondaryMarchAccomplishment + $secondaryunitContributeAcc->MarchAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryMarchAccomplishment = $tertiaryMarchAccomplishment + $tertiaryunitContributeAcc->MarchAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryMarchTotalAccomplishment = $secondaryMarchAccomplishment + $tertiaryMarchAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitMarchCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->MarchAccomplishment + $secondaryMarchTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitMarchCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Marchchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->AprilAccomplishment, 2) }}
                            <?php
                                $totalAprilContribution = 0;
                                $unit_Aprilchecker = null;
                                $unitAprilCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryAprilTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryAprilAccomplishment = 0;
                                            $tertiaryAprilAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryAprilAccomplishment = $secondaryAprilAccomplishment + $secondaryunitContributeAcc->AprilAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryAprilAccomplishment = $tertiaryAprilAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryAprilTotalAccomplishment = $secondaryAprilAccomplishment + $tertiaryAprilAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalAprilContribution = $contributory->AprilAccomplishment + $secondaryAprilTotalAccomplishment;
                                            $unit_Aprilchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Aprilchecker != null && $totalAprilContribution != 0)
                                <b>+{{ round($totalAprilContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryAprilTotalAccomplishment = 0;
                                                $unitAprilCounter = $unitAprilCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryAprilAccomplishment = 0;
                                                    $tertiaryAprilAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryAprilAccomplishment = $secondaryAprilAccomplishment + $secondaryunitContributeAcc->AprilAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryAprilAccomplishment = $tertiaryAprilAccomplishment + $tertiaryunitContributeAcc->AprilAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryAprilTotalAccomplishment = $secondaryAprilAccomplishment + $tertiaryAprilAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitAprilCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AprilAccomplishment + $secondaryAprilTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitAprilCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Aprilchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->MayTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->MayAccomplishment, 2) }}
                            <?php
                                $totalMayContribution = 0;
                                $unit_Maychecker = null;
                                $unitMayCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryMayTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryMayAccomplishment = 0;
                                            $tertiaryMayAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryMayAccomplishment = $secondaryMayAccomplishment + $secondaryunitContributeAcc->MayAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryMayAccomplishment = $tertiaryMayAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryMayTotalAccomplishment = $secondaryMayAccomplishment + $tertiaryMayAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalMayContribution = $contributory->MayAccomplishment + $secondaryMayTotalAccomplishment;
                                            $unit_Maychecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Maychecker != null && $totalMayContribution != 0)
                                <b>+{{ round($totalMayContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryMayTotalAccomplishment = 0;
                                                $unitMayCounter = $unitMayCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryMayAccomplishment = 0;
                                                    $tertiaryMayAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryMayAccomplishment = $secondaryMayAccomplishment + $secondaryunitContributeAcc->MayAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryMayAccomplishment = $tertiaryMayAccomplishment + $tertiaryunitContributeAcc->MayAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryMayTotalAccomplishment = $secondaryMayAccomplishment + $tertiaryMayAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitMayCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->MayAccomplishment + $secondaryMayTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitMayCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Maychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->JuneAccomplishment, 2) }}
                            <?php
                                $totalJuneContribution = 0;
                                $unit_Junechecker = null;
                                $unitJuneCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryJuneTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryJuneAccomplishment = 0;
                                            $tertiaryJuneAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryJuneAccomplishment = $secondaryJuneAccomplishment + $secondaryunitContributeAcc->JuneAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryJuneAccomplishment = $tertiaryJuneAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryJuneTotalAccomplishment = $secondaryJuneAccomplishment + $tertiaryJuneAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalJuneContribution = $contributory->JuneAccomplishment + $secondaryJuneTotalAccomplishment;
                                            $unit_Junechecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Junechecker != null && $totalJuneContribution != 0)
                                <b>+{{ round($totalJuneContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryJuneTotalAccomplishment = 0;
                                                $unitJuneCounter = $unitJuneCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryJuneAccomplishment = 0;
                                                    $tertiaryJuneAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryJuneAccomplishment = $secondaryJuneAccomplishment + $secondaryunitContributeAcc->JuneAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryJuneAccomplishment = $tertiaryJuneAccomplishment + $tertiaryunitContributeAcc->JuneAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryJuneTotalAccomplishment = $secondaryJuneAccomplishment + $tertiaryJuneAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitJuneCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JuneAccomplishment + $secondaryJuneTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitJuneCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Junechecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->JulyAccomplishment, 2) }}
                            <?php
                                $totalJulyContribution = 0;
                                $unit_Julychecker = null;
                                $unitJulyCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryJulyTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryJulyAccomplishment = 0;
                                            $tertiaryJulyAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryJulyAccomplishment = $secondaryJulyAccomplishment + $secondaryunitContributeAcc->JulyAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryJulyAccomplishment = $tertiaryJulyAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryJulyTotalAccomplishment = $secondaryJulyAccomplishment + $tertiaryJulyAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalJulyContribution = $contributory->JulyAccomplishment + $secondaryJulyTotalAccomplishment;
                                            $unit_Julychecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Julychecker != null && $totalJulyContribution != 0)
                                <b>+{{ round($totalJulyContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryJulyTotalAccomplishment = 0;
                                                $unitJulyCounter = $unitJulyCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryJulyAccomplishment = 0;
                                                    $tertiaryJulyAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryJulyAccomplishment = $secondaryJulyAccomplishment + $secondaryunitContributeAcc->JulyAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryJulyAccomplishment = $tertiaryJulyAccomplishment + $tertiaryunitContributeAcc->JulyAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryJulyTotalAccomplishment = $secondaryJulyAccomplishment + $tertiaryJulyAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitJulyCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->JulyAccomplishment + $secondaryJulyTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitJulyCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Julychecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->AugustAccomplishment, 2) }}
                            <?php
                                $totalAugustContribution = 0;
                                $unit_Augustchecker = null;
                                $unitAugustCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryAugustTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryAugustAccomplishment = 0;
                                            $tertiaryAugustAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryAugustAccomplishment = $secondaryAugustAccomplishment + $secondaryunitContributeAcc->AugustAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryAugustAccomplishment = $tertiaryAugustAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryAugustTotalAccomplishment = $secondaryAugustAccomplishment + $tertiaryAugustAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalAugustContribution = $contributory->AugustAccomplishment + $secondaryAugustTotalAccomplishment;
                                            $unit_Augustchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Augustchecker != null && $totalAugustContribution != 0)
                                <b>+{{ round($totalAugustContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryAugustTotalAccomplishment = 0;
                                                $unitAugustCounter = $unitAugustCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryAugustAccomplishment = 0;
                                                    $tertiaryAugustAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryAugustAccomplishment = $secondaryAugustAccomplishment + $secondaryunitContributeAcc->AugustAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryAugustAccomplishment = $tertiaryAugustAccomplishment + $tertiaryunitContributeAcc->AugustAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryAugustTotalAccomplishment = $secondaryAugustAccomplishment + $tertiaryAugustAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitAugustCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->AugustAccomplishment + $secondaryAugustTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitAugustCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Augustchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->SeptemberAccomplishment, 2) }}
                            <?php
                                $totalSeptemberContribution = 0;
                                $unit_Septemberchecker = null;
                                $unitSeptemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondarySeptemberTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondarySeptemberAccomplishment = 0;
                                            $tertiarySeptemberAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondarySeptemberAccomplishment = $secondarySeptemberAccomplishment + $secondaryunitContributeAcc->SeptemberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiarySeptemberAccomplishment = $tertiarySeptemberAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondarySeptemberTotalAccomplishment = $secondarySeptemberAccomplishment + $tertiarySeptemberAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalSeptemberContribution = $contributory->SeptemberAccomplishment + $secondarySeptemberTotalAccomplishment;
                                            $unit_Septemberchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Septemberchecker != null && $totalSeptemberContribution != 0)
                                <b>+{{ round($totalSeptemberContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondarySeptemberTotalAccomplishment = 0;
                                                $unitSeptemberCounter = $unitSeptemberCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondarySeptemberAccomplishment = 0;
                                                    $tertiarySeptemberAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondarySeptemberAccomplishment = $secondarySeptemberAccomplishment + $secondaryunitContributeAcc->SeptemberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiarySeptemberAccomplishment = $tertiarySeptemberAccomplishment + $tertiaryunitContributeAcc->SeptemberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondarySeptemberTotalAccomplishment = $secondarySeptemberAccomplishment + $tertiarySeptemberAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitSeptemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->SeptemberAccomplishment + $secondarySeptemberTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitSeptemberCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Septemberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->OctoberAccomplishment, 2) }}
                            <?php
                                $totalOctoberContribution = 0;
                                $unit_Octoberchecker = null;
                                $unitOctoberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryOctoberTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryOctoberAccomplishment = 0;
                                            $tertiaryOctoberAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryOctoberAccomplishment = $secondaryOctoberAccomplishment + $secondaryunitContributeAcc->OctoberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryOctoberAccomplishment = $tertiaryOctoberAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryOctoberTotalAccomplishment = $secondaryOctoberAccomplishment + $tertiaryOctoberAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalOctoberContribution = $contributory->OctoberAccomplishment + $secondaryOctoberTotalAccomplishment;
                                            $unit_Octoberchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Octoberchecker != null && $totalOctoberContribution != 0)
                                <b>+{{ round($totalOctoberContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryOctoberTotalAccomplishment = 0;
                                                $unitOctoberCounter = $unitOctoberCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryOctoberAccomplishment = 0;
                                                    $tertiaryOctoberAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryOctoberAccomplishment = $secondaryOctoberAccomplishment + $secondaryunitContributeAcc->OctoberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryOctoberAccomplishment = $tertiaryOctoberAccomplishment + $tertiaryunitContributeAcc->OctoberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryOctoberTotalAccomplishment = $secondaryOctoberAccomplishment + $tertiaryOctoberAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitOctoberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->OctoberAccomplishment + $secondaryOctoberTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitOctoberCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Octoberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->NovemberAccomplishment, 2) }}
                            <?php
                                $totalNovemberContribution = 0;
                                $unit_Novemberchecker = null;
                                $unitNovemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryNovemberTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryNovemberAccomplishment = 0;
                                            $tertiaryNovemberAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryNovemberAccomplishment = $secondaryNovemberAccomplishment + $secondaryunitContributeAcc->NovemberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryNovemberAccomplishment = $tertiaryNovemberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryNovemberTotalAccomplishment = $secondaryNovemberAccomplishment + $tertiaryNovemberAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalNovemberContribution = $contributory->NovemberAccomplishment + $secondaryNovemberTotalAccomplishment;
                                            $unit_Novemberchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Novemberchecker != null && $totalNovemberContribution != 0)
                                <b>+{{ round($totalNovemberContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryNovemberTotalAccomplishment = 0;
                                                $unitNovemberCounter = $unitNovemberCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryNovemberAccomplishment = 0;
                                                    $tertiaryNovemberAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryNovemberAccomplishment = $secondaryNovemberAccomplishment + $secondaryunitContributeAcc->NovemberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryNovemberAccomplishment = $tertiaryNovemberAccomplishment + $tertiaryunitContributeAcc->NovemberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryNovemberTotalAccomplishment = $secondaryNovemberAccomplishment + $tertiaryNovemberAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitNovemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->NovemberAccomplishment + $secondaryNovemberTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitNovemberCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Novemberchecker != null)
                                        )
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b>
                            <br>
                            {{ round($accomplishment->staff_accomplishment->DecemberAccomplishment, 2) }}
                            <?php
                                $totalDecemberContribution = 0;
                                $unit_Decemberchecker = null;
                                $unitDecemberCounter = 0;
                            ?>
                            <br>
                            @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                @foreach($contributor->unit_accomplishments as $contributory)
                                    <?php
                                        $secondaryDecemberTotalAccomplishment = 0;
                                    ?>
                                    @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                        <?php
                                            $secondaryDecemberAccomplishment = 0;
                                            $tertiaryDecemberAccomplishment = 0;
                                        ?>           
                                        @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                            <?php
                                                $secondaryDecemberAccomplishment = $secondaryDecemberAccomplishment + $secondaryunitContributeAcc->DecemberAccomplishment;
                                            ?>
                                        @endforeach
                                        @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                            @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                <?php
                                                    $tertiaryDecemberAccomplishment = $tertiaryDecemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                ?>
                                            @endforeach
                                        @endforeach
                                        <?php
                                            $secondaryDecemberTotalAccomplishment = $secondaryDecemberAccomplishment + $tertiaryDecemberAccomplishment;
                                        ?>
                                    @endforeach
                                    <normal>
                                        <?php
                                            $totalDecemberContribution = $contributory->DecemberAccomplishment + $secondaryDecemberTotalAccomplishment;
                                            $unit_Decemberchecker = $contributory->unit->UnitAbbreviation;
                                        ?>
                                    </normal>
                                @endforeach
                            @endforeach
                            @if($unit_Decemberchecker != null && $totalDecemberContribution != 0)
                                <b>+{{ round($totalDecemberContribution, 2) }}</b>
                                @if($reportType == 'breakdown')
                                    <br>
                                    @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                        @foreach($contributor->unit_accomplishments as $contributory)
                                            <?php
                                                $secondaryDecemberTotalAccomplishment = 0;
                                                $unitDecemberCounter = $unitDecemberCounter + 1;
                                            ?>
                                            @foreach($contributor->secondary_unit_measures as $secondaryContributory)
                                                <?php
                                                    $secondaryDecemberAccomplishment = 0;
                                                    $tertiaryDecemberAccomplishment = 0;
                                                ?>           
                                                @foreach($secondaryContributory->secondary_unit_accomplishments as $secondaryunitContributeAcc)
                                                    <?php
                                                        $secondaryDecemberAccomplishment = $secondaryDecemberAccomplishment + $secondaryunitContributeAcc->DecemberAccomplishment;
                                                    ?>
                                                @endforeach
                                                @foreach($secondaryContributory->tertiary_unit_measures as $tertiaryContributory)           
                                                    @foreach($tertiaryContributory->tertiary_unit_accomplishments as $tertiaryunitContributeAcc)
                                                        <?php
                                                            $tertiaryDecemberAccomplishment = $tertiaryDecemberAccomplishment + $tertiaryunitContributeAcc->DecemberAccomplishment;
                                                        ?>
                                                    @endforeach
                                                @endforeach
                                                <?php
                                                    $secondaryDecemberTotalAccomplishment = $secondaryDecemberAccomplishment + $tertiaryDecemberAccomplishment;
                                                ?>
                                            @endforeach
                                            <normal>
                                                @if($unitDecemberCounter == 1)
                                                    (
                                                @endif
                                                {{ round(($contributory->DecemberAccomplishment + $secondaryDecemberTotalAccomplishment), 2) }}-<span class="label">{{ $contributory->unit->UnitAbbreviation }}</span>@if($unitDecemberCounter != count($contributor->unit_accomplishments)),@endif
                                            </normal>
                                        @endforeach
                                    @endforeach
                                    @if($unit_Decemberchecker != null)
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