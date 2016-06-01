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
                        ->where('staff_objectives.StaffID', '=', $staff_id)
                        ->orderBy('staff_objectives.StaffObjectiveName', 'asc')
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
            @foreach($sortByObjective as $measure)
            <?php
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
                            {{-- JANUARY --}}
                            <td>
                                {{ round($accomplishment->JanuaryTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJanuaryContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJanuaryContribution = $totalJanuaryContribution + $contributory->JanuaryAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- FEBRUARY --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalFebruaryContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalFebruaryContribution = $totalFebruaryContribution + $contributory->FebruaryAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- MARCH --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMarchContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalMarchContribution = $totalMarchContribution + $contributory->MarchAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- APRIL --}}
                            <td>
                                {{ round($accomplishment->AprilTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalAprilContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalAprilContribution = $totalAprilContribution + $contributory->AprilAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- MAY --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalMayContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalMayContribution = $totalMayContribution + $contributory->MayAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- JUNE --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJuneContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJuneContribution = $totalJuneContribution + $contributory->JuneAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- JULY --}}
                            <td>
                                {{ round($accomplishment->JulyTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalJulyContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalJulyContribution = $totalJulyContribution + $contributory->JulyAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- AUGUST --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalAugustContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalAugustContribution = $totalAugustContribution + $contributory->AugustAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- SEPTEMBER --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalSeptemberContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalSeptemberContribution = $totalSeptemberContribution + $contributory->SeptemberAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- OCTOBER --}}
                            <td>
                                {{ round($accomplishment->OctoberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalOctoberContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalOctoberContribution = $totalOctoberContribution + $contributory->OctoberAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- NOVEMBER --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalNovemberContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalNovemberContribution = $totalNovemberContribution + $contributory->NovemberAccomplishment;
                                            ?>
                                        </div>
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
                            {{-- DECEMBER --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            </td>
                            <td>
                                <?php
                                    $totalDecemberContribution = 0;
                                ?>
                                @foreach($accomplishment->staff_measure->unit_measures as $contributor)
                                    @foreach($contributor->unit_accomplishments as $contributory)
                                        <div>
                                            <?php
                                                $totalDecemberContribution = $totalDecemberContribution + $contributory->DecemberAccomplishment;
                                            ?>
                                        </div>
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
</body>