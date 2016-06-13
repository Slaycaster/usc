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

    $chief_id = Session::get('chief_id', 'default'); //get the UserChiefID stored in session.
     
    $chief = Chief::where('ChiefID', '=', $chief_id)->first();

    $logoPath = 'img/pnp_logo2.png';
    $chieflogoPath = 'uploads/chiefpictures/cropped/'.$chief->PicturePath;
    $tempObjective = '';



    $sortByObjective = DB::table('chief_objectives')
                        ->join('chief_measures', 'chief_objectives.ChiefObjectiveID', '=', 'chief_measures.ChiefObjectiveID')
                        ->where('chief_objectives.ChiefID', '=', $chief_id)
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
                                        ->where('ChiefID', '=', $chief_id)
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
                                                ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.secondary_unit_accomplishments')
                                                ->with('chief_measure.staff_measures.unit_measures.secondary_unit_measures.tertiary_unit_measures.tertiary_unit_accomplishments')
                                                ->with('chief_accomplishment')
                                                ->with('chief_owner')
                                                ->with('chief_initiative')
                                                ->with('chief_funding')
                                                ->with('user_chief')
                                                ->with('user_chief.rank')
                                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                                ->where('ChiefID', '=', $chief_id)
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
                            <td>{{--January--}}
                                {{ round($accomplishment->JanuaryTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalJanuaryContribution = 0;
                                    $staff_Januarychecker = null;
                                    $staffJanuaryCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJanuaryContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryJanuaryTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitJanuaryContribution = $unitContributeAcc->JanuaryAccomplishment + $secondaryJanuaryTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalJanuaryContribution = $unitJanuaryContribution + $contributory->JanuaryAccomplishment+$unitJanuaryContribution;
                                            $staff_Januarychecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalJanuaryContribution != 0 && $staff_Januarychecker != null)
                                    <b>{{ $totalJanuaryContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitJanuaryContribution = 0;
                                                    $staffJanuaryCounter = $staffJanuaryCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryJanuaryTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitJanuaryContribution = $unitContributeAcc->JanuaryAccomplishment + $secondaryJanuaryTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffJanuaryCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->JanuaryAccomplishment+$unitJanuaryContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffJanuaryCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Januarychecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--February--}}
                                {{ round($accomplishment->FebruaryTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalFebruaryContribution = 0;
                                    $staff_Februarychecker = null;
                                    $staffFebruaryCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitFebruaryContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryFebruaryTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitFebruaryContribution = $unitContributeAcc->FebruaryAccomplishment + $secondaryFebruaryTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalFebruaryContribution = $unitFebruaryContribution + $contributory->FebruaryAccomplishment+$unitFebruaryContribution;
                                            $staff_Februarychecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalFebruaryContribution != 0 && $staff_Februarychecker != null)
                                    <b>{{ $totalFebruaryContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitFebruaryContribution = 0;
                                                    $staffFebruaryCounter = $staffFebruaryCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryFebruaryTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitFebruaryContribution = $unitContributeAcc->FebruaryAccomplishment + $secondaryFebruaryTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffFebruaryCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->FebruaryAccomplishment+$unitFebruaryContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffFebruaryCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Februarychecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--March--}}
                                {{ round($accomplishment->MarchTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalMarchContribution = 0;
                                    $staff_Marchchecker = null;
                                    $staffMarchCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitMarchContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryMarchTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitMarchContribution = $unitContributeAcc->MarchAccomplishment + $secondaryMarchTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalMarchContribution = $unitMarchContribution + $contributory->MarchAccomplishment+$unitMarchContribution;
                                            $staff_Marchchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalMarchContribution != 0 && $staff_Marchchecker != null)
                                    <b>{{ $totalMarchContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitMarchContribution = 0;
                                                    $staffMarchCounter = $staffMarchCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryMarchTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitMarchContribution = $unitContributeAcc->MarchAccomplishment + $secondaryMarchTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffMarchCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->MarchAccomplishment+$unitMarchContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffMarchCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Marchchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--April--}}
                                {{ round($accomplishment->AprilTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalAprilContribution = 0;
                                    $staff_Aprilchecker = null;
                                    $staffAprilCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitAprilContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryAprilTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitAprilContribution = $unitContributeAcc->AprilAccomplishment + $secondaryAprilTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalAprilContribution = $unitAprilContribution + $contributory->AprilAccomplishment+$unitAprilContribution;
                                            $staff_Aprilchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalAprilContribution != 0 && $staff_Aprilchecker != null)
                                    <b>{{ $totalAprilContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitAprilContribution = 0;
                                                    $staffAprilCounter = $staffAprilCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryAprilTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitAprilContribution = $unitContributeAcc->AprilAccomplishment + $secondaryAprilTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffAprilCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->AprilAccomplishment+$unitAprilContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffAprilCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Aprilchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--May--}}
                                {{ round($accomplishment->MayTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalMayContribution = 0;
                                    $staff_Maychecker = null;
                                    $staffMayCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitMayContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryMayTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitMayContribution = $unitContributeAcc->MayAccomplishment + $secondaryMayTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalMayContribution = $unitMayContribution + $contributory->MayAccomplishment+$unitMayContribution;
                                            $staff_Maychecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalMayContribution != 0 && $staff_Maychecker != null)
                                    <b>{{ $totalMayContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitMayContribution = 0;
                                                    $staffMayCounter = $staffMayCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryMayTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitMayContribution = $unitContributeAcc->MayAccomplishment + $secondaryMayTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffMayCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->MayAccomplishment+$unitMayContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffMayCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Maychecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--June--}}
                                {{ round($accomplishment->JuneTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalJuneContribution = 0;
                                    $staff_Junechecker = null;
                                    $staffJuneCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJuneContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryJuneTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitJuneContribution = $unitContributeAcc->JuneAccomplishment + $secondaryJuneTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalJuneContribution = $unitJuneContribution + $contributory->JuneAccomplishment+$unitJuneContribution;
                                            $staff_Junechecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalJuneContribution != 0 && $staff_Junechecker != null)
                                    <b>{{ $totalJuneContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitJuneContribution = 0;
                                                    $staffJuneCounter = $staffJuneCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryJuneTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitJuneContribution = $unitContributeAcc->JuneAccomplishment + $secondaryJuneTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffJuneCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->JuneAccomplishment+$unitJuneContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffJuneCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Junechecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--July--}}
                                {{ round($accomplishment->JulyTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalJulyContribution = 0;
                                    $staff_Julychecker = null;
                                    $staffJulyCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitJulyContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryJulyTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitJulyContribution = $unitContributeAcc->JulyAccomplishment + $secondaryJulyTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalJulyContribution = $unitJulyContribution + $contributory->JulyAccomplishment+$unitJulyContribution;
                                            $staff_Julychecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalJulyContribution != 0 && $staff_Julychecker != null)
                                    <b>{{ $totalJulyContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitJulyContribution = 0;
                                                    $staffJulyCounter = $staffJulyCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryJulyTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitJulyContribution = $unitContributeAcc->JulyAccomplishment + $secondaryJulyTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffJulyCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->JulyAccomplishment+$unitJulyContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffJulyCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Julychecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--August--}}
                                {{ round($accomplishment->AugustTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalAugustContribution = 0;
                                    $staff_Augustchecker = null;
                                    $staffAugustCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitAugustContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryAugustTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitAugustContribution = $unitContributeAcc->AugustAccomplishment + $secondaryAugustTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalAugustContribution = $unitAugustContribution + $contributory->AugustAccomplishment+$unitAugustContribution;
                                            $staff_Augustchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalAugustContribution != 0 && $staff_Augustchecker != null)
                                    <b>{{ $totalAugustContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitAugustContribution = 0;
                                                    $staffAugustCounter = $staffAugustCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryAugustTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitAugustContribution = $unitContributeAcc->AugustAccomplishment + $secondaryAugustTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffAugustCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->AugustAccomplishment+$unitAugustContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffAugustCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Augustchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--September--}}
                                {{ round($accomplishment->SeptemberTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalSeptemberContribution = 0;
                                    $staff_Septemberchecker = null;
                                    $staffSeptemberCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitSeptemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondarySeptemberTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitSeptemberContribution = $unitContributeAcc->SeptemberAccomplishment + $secondarySeptemberTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalSeptemberContribution = $unitSeptemberContribution + $contributory->SeptemberAccomplishment+$unitSeptemberContribution;
                                            $staff_Septemberchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalSeptemberContribution != 0 && $staff_Septemberchecker != null)
                                    <b>{{ $totalSeptemberContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitSeptemberContribution = 0;
                                                    $staffSeptemberCounter = $staffSeptemberCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondarySeptemberTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitSeptemberContribution = $unitContributeAcc->SeptemberAccomplishment + $secondarySeptemberTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffSeptemberCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->SeptemberAccomplishment+$unitSeptemberContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffSeptemberCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Septemberchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--October--}}
                                {{ round($accomplishment->OctoberTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalOctoberContribution = 0;
                                    $staff_Octoberchecker = null;
                                    $staffOctoberCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitOctoberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryOctoberTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitOctoberContribution = $unitContributeAcc->OctoberAccomplishment + $secondaryOctoberTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalOctoberContribution = $unitOctoberContribution + $contributory->OctoberAccomplishment+$unitOctoberContribution;
                                            $staff_Octoberchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalOctoberContribution != 0 && $staff_Octoberchecker != null)
                                    <b>{{ $totalOctoberContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitOctoberContribution = 0;
                                                    $staffOctoberCounter = $staffOctoberCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryOctoberTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitOctoberContribution = $unitContributeAcc->OctoberAccomplishment + $secondaryOctoberTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffOctoberCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->OctoberAccomplishment+$unitOctoberContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffOctoberCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Octoberchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--November--}}
                                {{ round($accomplishment->NovemberTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalNovemberContribution = 0;
                                    $staff_Novemberchecker = null;
                                    $staffNovemberCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitNovemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryNovemberTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitNovemberContribution = $unitContributeAcc->NovemberAccomplishment + $secondaryNovemberTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalNovemberContribution = $unitNovemberContribution + $contributory->NovemberAccomplishment+$unitNovemberContribution;
                                            $staff_Novemberchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalNovemberContribution != 0 && $staff_Novemberchecker != null)
                                    <b>{{ $totalNovemberContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitNovemberContribution = 0;
                                                    $staffNovemberCounter = $staffNovemberCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryNovemberTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitNovemberContribution = $unitContributeAcc->NovemberAccomplishment + $secondaryNovemberTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffNovemberCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->NovemberAccomplishment+$unitNovemberContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffNovemberCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Novemberchecker != null)
                                            )
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{--December--}}
                                {{ round($accomplishment->DecemberTarget, 2) }}<b>/ </b><br>
                                <?php
                                    $totalDecemberContribution = 0;
                                    $staff_Decemberchecker = null;
                                    $staffDecemberCounter = 0;
                                ?>
                                @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                    @foreach($contributor->staff_accomplishments as $contributory)
                                        <?php
                                            $unitDecemberContribution = 0;
                                        ?>
                                        @foreach($contributor->unit_measures as $unitContribute)
                                            @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                <?php
                                                    $secondaryDecemberTotalAccomplishment = 0;
                                                ?>
                                                @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                        $unitDecemberContribution = $unitContributeAcc->DecemberAccomplishment + $secondaryDecemberTotalAccomplishment;
                                                    ?>
                                                </normal>
                                            @endforeach
                                        @endforeach 
                                        <?php
                                            $totalDecemberContribution = $unitDecemberContribution + $contributory->DecemberAccomplishment+$unitDecemberContribution;
                                            $staff_Decemberchecker = $contributory->staff->StaffAbbreviation;
                                        ?> 
                                    @endforeach
                                @endforeach
                                @if($totalDecemberContribution != 0 && $staff_Decemberchecker != null)
                                    <b>{{ $totalDecemberContribution }}</b>
                                    @if($reportType == 'breakdown')
                                        <br>
                                        @foreach($accomplishment->chief_measure->staff_measures as $contributor)
                                            @foreach($contributor->staff_accomplishments as $contributory)
                                                <?php
                                                    $unitDecemberContribution = 0;
                                                    $staffDecemberCounter = $staffDecemberCounter + 1;
                                                ?>
                                                @foreach($contributor->unit_measures as $unitContribute)
                                                    @foreach($unitContribute->unit_accomplishments as $unitContributeAcc)
                                                        <?php
                                                            $secondaryDecemberTotalAccomplishment = 0;
                                                        ?>
                                                        @foreach($unitContribute->secondary_unit_measures as $secondaryContributory)
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
                                                                $unitDecemberContribution = $unitContributeAcc->DecemberAccomplishment + $secondaryDecemberTotalAccomplishment;
                                                            ?>
                                                        </normal>
                                                    @endforeach
                                                @endforeach 
                                                <br>
                                                <normal>
                                                    @if($staffDecemberCounter == 1)
                                                        (
                                                    @endif
                                                    {{ round(($contributory->DecemberAccomplishment+$unitDecemberContribution), 2) }}-<span class="labelC">{{ $contributory->staff->StaffAbbreviation }}</span></span>@if($staffDecemberCounter != count($contributor->staff_accomplishments)),@endif
                                                </normal>
                                            @endforeach
                                        @endforeach
                                        @if($staff_Decemberchecker != null)
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