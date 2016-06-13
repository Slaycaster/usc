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
    $selectedQuarter = Session::get('quarter', 'default');  

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
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $staff->StaffAbbreviation }} KPI for Q{{ $selectedQuarter }} {{ $selectedYear }}</p>
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
                $overallAccomplishment = 0;
                $overallTarget = 0;
            ?>
            <tbody>
                @foreach($accomplishments as $accomplishment)
                    <tr style="font-family: arial;">
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
                                        <span class="label label-default">{{ $contributory->unit->UnitAbbreviation }}</span>
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
                            {{ $accomplishment->staff_measure->StaffMeasureFormula }}
                        </td>
                        @if($selectedQuarter == '1')
                            {{-- January --}}
                            <td>
                                {{ round($accomplishment->JanuaryTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJanuaryContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJanuaryAccomplishment = $accomplishment->staff_accomplishment->JanuaryAccomplishment + $totalJanuaryContribution;
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
                                    $JanuaryPerformance = round(($totalJanuaryAccomplishment / $JanuaryTarget) * 100, 2);
                                ?>
                                {{ round($JanuaryPerformance, 2) }}%
                            </td>
                            {{-- February --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalFebruaryContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalFebruaryAccomplishment = $accomplishment->staff_accomplishment->FebruaryAccomplishment + $totalFebruaryContribution;
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
                                    $FebruaryPerformance = round(($totalFebruaryAccomplishment / $FebruaryTarget) * 100, 2);
                                ?>
                                {{ round($FebruaryPerformance, 2) }}%
                            </td>
                            {{-- March --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMarchContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMarchAccomplishment = $accomplishment->staff_accomplishment->MarchAccomplishment + $totalMarchContribution;
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
                                    $MarchPerformance = round(($totalMarchAccomplishment / $MarchTarget) * 100, 2);
                                ?>
                                {{ round($MarchPerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '2')
                            {{-- April --}}
                            <td>
                                {{ round($accomplishment->AprilTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalAprilContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAprilAccomplishment = $accomplishment->staff_accomplishment->AprilAccomplishment + $totalAprilContribution;
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
                                    $AprilPerformance = round(($totalAprilAccomplishment / $AprilTarget) * 100, 2);
                                ?>
                                {{ round($AprilPerformance, 2) }}%
                            </td>
                            {{-- May --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMayContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalMayAccomplishment = $accomplishment->staff_accomplishment->MayAccomplishment + $totalMayContribution;
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
                                    $MayPerformance = round(($totalMayAccomplishment / $MayTarget) * 100, 2);
                                ?>
                                {{ round($MayPerformance, 2) }}%
                            </td>
                            {{-- June --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJuneContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJuneAccomplishment = $accomplishment->staff_accomplishment->JuneAccomplishment + $totalJuneContribution;
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
                                    $JunePerformance = round(($totalJuneAccomplishment / $JuneTarget) * 100, 2);
                                ?>
                                {{ round($JunePerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '3')
                            {{-- July --}}
                            <td>
                                {{ round($accomplishment->JulyTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJulyContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalJulyAccomplishment = $accomplishment->staff_accomplishment->JulyAccomplishment + $totalJulyContribution;
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
                                    $JulyPerformance = round(($totalJulyAccomplishment / $JulyTarget) * 100, 2);
                                ?>
                                {{ round($JulyPerformance, 2) }}%
                            </td>
                            {{-- August --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalAugustContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalAugustAccomplishment = $accomplishment->staff_accomplishment->AugustAccomplishment + $totalAugustContribution;
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
                                    $AugustPerformance = round(($totalAugustAccomplishment / $AugustTarget) * 100, 2);
                                ?>
                                {{ round($AugustPerformance, 2) }}%
                            </td>
                            {{-- September --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalSeptemberContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalSeptemberAccomplishment = $accomplishment->staff_accomplishment->SeptemberAccomplishment + $totalSeptemberContribution;
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
                                    $SeptemberPerformance = round(($totalSeptemberAccomplishment / $SeptemberTarget) * 100, 2);
                                ?>
                                {{ round($SeptemberPerformance, 2) }}%
                            </td>
                        @endif
                        @if($selectedQuarter == '4')
                            {{-- October --}}
                            <td>
                                {{ round($accomplishment->OctoberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalOctoberContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalOctoberAccomplishment = $accomplishment->staff_accomplishment->OctoberAccomplishment + $totalOctoberContribution;
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
                                    $OctoberPerformance = round(($totalOctoberAccomplishment / $OctoberTarget) * 100, 2);
                                ?>
                                {{ round($OctoberPerformance, 2) }}%
                            </td>
                            {{-- November --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalNovemberContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalNovemberAccomplishment = $accomplishment->staff_accomplishment->NovemberAccomplishment + $totalNovemberContribution;
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
                                    $NovemberPerformance = round(($totalNovemberAccomplishment / $NovemberTarget) * 100, 2);
                                ?>
                                {{ round($NovemberPerformance, 2) }}%
                            </td>
                            {{-- December --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalDecemberContribution = 0;
                                ?>
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
                                            ?>
                                        </normal>
                                    @endforeach
                                @endforeach
                                <?php
                                    $totalDecemberAccomplishment = $accomplishment->staff_accomplishment->DecemberAccomplishment + $totalDecemberContribution;
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
                                    $DecemberPerformance = round(($totalDecemberAccomplishment / $DecemberTarget) * 100, 2);
                                ?>
                                {{ round($DecemberPerformance, 2) }}%
                            </td>
                        @endif



                        @if($accomplishment->staff_measure->StaffMeasureFormula == 'Summation')
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