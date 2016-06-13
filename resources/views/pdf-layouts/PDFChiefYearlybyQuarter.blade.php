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
    $reportType = Session::get('reportType', 'default');    

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
                        ->where('chief_objectives.ChiefID', '=', $chief_user->ChiefID)
                        ->orderBy('chief_objectives.ChiefObjectiveName', 'asc')
                        ->orderBy('chief_measures.ChiefMeasureID', 'asc')
                        ->get();
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = ChiefTarget::with('chief_measure')
                                        ->with('chief_measure.chief_objective')
                                        ->with('chief_measure.staff_measures.staff_accomplishments')
                                        ->with('chief_measure.staff_measures.staff_accomplishments.staff')
                                        ->with('chief_measure.staff_measures.unit_measures.unit_accomplishments')
                                        ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
                                        ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
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
        .labelC
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
                $accomplishments = ChiefTarget::with('chief_measure')
                                                ->with('chief_measure.chief_objective')
                                                ->with('chief_measure.staff_measures.staff_accomplishments')
                                                ->with('chief_measure.staff_measures.staff_accomplishments.staff')
                                                ->with('chief_measure.staff_measures.unit_measures.unit_accomplishments')
                                                ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
                                                ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
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
                            <td>{{--FirstQuarter--}}
                                {{ round(($accomplishment->JanuaryTarget + $accomplishment->FebruaryTarget + $accomplishment->MarchTarget), 2) }}<b>/ </b><br>
                                <?php
                                    $totalFirstQuarterContribution = 0;
                                    $staff_FirstQuarterchecker = null;
                                    $staffFirstQuarterCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitFirstQuarterContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryFirstQuarterTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitFirstQuarterContribution = $secondaryFirstQuarterTotalAccomplishment + $unitContributeAcc->JanuaryAccomplishment + $unitContributeAcc->FebruaryAccomplishment + $unitContributeAcc->MarchAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalFirstQuarterContribution = $unitFirstQuarterContribution + $contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment;
                                            $staff_FirstQuarterchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalFirstQuarterContribution != 0 && $staff_FirstQuarterchecker != null)
                                    <b>{{ $totalFirstQuarterContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitFirstQuarterContribution = 0;
                                                    $staffFirstQuarterCounter = $staffFirstQuarterCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryFirstQuarterTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitFirstQuarterContribution = $secondaryFirstQuarterTotalAccomplishment + $unitContributeAcc->JanuaryAccomplishment + $unitContributeAcc->FebruaryAccomplishment + $unitContributeAcc->MarchAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach
                                                <normal>
                                                    @if($staffFirstQuarterCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($unitFirstQuarterContribution + $contributory->JanuaryAccomplishment + $contributory->FebruaryAccomplishment + $contributory->MarchAccomplishment), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffFirstQuarterCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_FirstQuarterchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--SecondQuarter--}}
                                {{ round(($accomplishment->AprilTarget + $accomplishment->MayTarget + $accomplishment->JuneTarget), 2) }}<b>/ </b><br>
                                <?php
                                    $totalSecondQuarterContribution = 0;
                                    $staff_SecondQuarterchecker = null;
                                    $staffSecondQuarterCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitSecondQuarterContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondarySecondQuarterTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitSecondQuarterContribution = $secondarySecondQuarterTotalAccomplishment + $unitContributeAcc->AprilAccomplishment + $unitContributeAcc->MayAccomplishment + $unitContributeAcc->JuneAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalSecondQuarterContribution = $unitSecondQuarterContribution + $contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment;
                                            $staff_SecondQuarterchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalSecondQuarterContribution != 0 && $staff_SecondQuarterchecker != null)
                                    <b>{{ $totalSecondQuarterContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitSecondQuarterContribution = 0;
                                                    $staffSecondQuarterCounter = $staffSecondQuarterCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondarySecondQuarterTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitSecondQuarterContribution = $secondarySecondQuarterTotalAccomplishment + $unitContributeAcc->AprilAccomplishment + $unitContributeAcc->MayAccomplishment + $unitContributeAcc->JuneAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach
                                                <normal>
                                                    @if($staffSecondQuarterCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($unitSecondQuarterContribution + $contributory->AprilAccomplishment + $contributory->MayAccomplishment + $contributory->JuneAccomplishment), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffSecondQuarterCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_SecondQuarterchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--ThirdQuarter--}}
                                {{ round(($accomplishment->JulyTarget + $accomplishment->AugustTarget + $accomplishment->SeptemberTarget), 2) }}<b>/ </b><br>
                                <?php
                                    $totalThirdQuarterContribution = 0;
                                    $staff_ThirdQuarterchecker = null;
                                    $staffThirdQuarterCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitThirdQuarterContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryThirdQuarterTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitThirdQuarterContribution = $secondaryThirdQuarterTotalAccomplishment + $unitContributeAcc->JulyAccomplishment + $unitContributeAcc->AugustAccomplishment + $unitContributeAcc->SeptemberAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalThirdQuarterContribution = $unitThirdQuarterContribution + $contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment;
                                            $staff_ThirdQuarterchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalThirdQuarterContribution != 0 && $staff_ThirdQuarterchecker != null)
                                    <b>{{ $totalThirdQuarterContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitThirdQuarterContribution = 0;
                                                    $staffThirdQuarterCounter = $staffThirdQuarterCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryThirdQuarterTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitThirdQuarterContribution = $secondaryThirdQuarterTotalAccomplishment + $unitContributeAcc->JulyAccomplishment + $unitContributeAcc->AugustAccomplishment + $unitContributeAcc->SeptemberAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach
                                                <normal>
                                                    @if($staffThirdQuarterCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($unitThirdQuarterContribution + $contributory->JulyAccomplishment + $contributory->AugustAccomplishment + $contributory->SeptemberAccomplishment), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffThirdQuarterCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_ThirdQuarterchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--FourthQuarter--}}
                                {{ round(($accomplishment->OctoberTarget + $accomplishment->NovemberTarget + $accomplishment->DecemberTarget), 2) }}<b>/ </b><br>
                                <?php
                                    $totalFourthQuarterContribution = 0;
                                    $staff_FourthQuarterchecker = null;
                                    $staffFourthQuarterCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitFourthQuarterContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryFourthQuarterTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitFourthQuarterContribution = $secondaryFourthQuarterTotalAccomplishment + $unitContributeAcc->OctoberAccomplishment + $unitContributeAcc->NovemberAccomplishment + $unitContributeAcc->DecemberAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalFourthQuarterContribution = $unitFourthQuarterContribution + $contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment;
                                            $staff_FourthQuarterchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalFourthQuarterContribution != 0 && $staff_FourthQuarterchecker != null)
                                    <b>{{ $totalFourthQuarterContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitFourthQuarterContribution = 0;
                                                    $staffFourthQuarterCounter = $staffFourthQuarterCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryFourthQuarterTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitFourthQuarterContribution = $secondaryFourthQuarterTotalAccomplishment + $unitContributeAcc->OctoberAccomplishment + $unitContributeAcc->NovemberAccomplishment + $unitContributeAcc->DecemberAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach
                                                <normal>
                                                    @if($staffFourthQuarterCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($unitFourthQuarterContribution + $contributory->OctoberAccomplishment + $contributory->NovemberAccomplishment + $contributory->DecemberAccomplishment), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffFourthQuarterCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_FourthQuarterchecker != null)
                                            )
                                        @endif
                                    @endif
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
    @if($checkAccomplishment == 0)
        <p>No Accomplisments found for the year {{ $selectedYear }}</p>
    @endif
</body>