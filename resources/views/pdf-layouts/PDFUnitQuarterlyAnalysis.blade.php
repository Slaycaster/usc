<?php
    
//Models
use App\UnitTarget;
use App\UnitMeasure;
use App\UnitObjective;
use App\Unit;
use App\UserUnit;
use App\UnitAccomplishment;
use App\UnitOwner;
use App\UnitInitiative;
use App\UnitFunding;

    $selectedYear = Session::get('year', 'default');
    $selectedQuarter = Session::get('quarter', 'default');    

    $unit_id = Session::get('unit_user_id', 'default');
    $unit_user = UserUnit::where('UserUnitID', '=', $unit_id)
                            ->first();
    $unit = UserUnit::where('UserUnitID', '=', $unit_id)->select('UnitID')->first(); //Get the Unit of the unit     
    
    $unit = Unit::where('UnitID', '=', $unit_user->UnitID)->first();
    $unit_objectives = UnitObjective::all();
    $unit_measures = UnitMeasure::with('unit')->where('UnitID', '=', $unit_user->UnitID)->get();

    $user = UserUnit::where('UserUnitID', $unit_id)
                    ->first();

    
    $logoPath = 'img/pnp_logo2.png';
    $unitlogoPath = 'uploads/unitpictures/cropped/'.$unit->PicturePath;
    $tempObjective = '';


    $sortByObjective = DB::table('unit_objectives')
                        ->join('unit_measures', 'unit_objectives.UnitObjectiveID', '=', 'unit_measures.UnitObjectiveID')
                        ->where('unit_objectives.UnitID', '=', $unit->UnitID)
                        ->orderBy('unit_objectives.UnitObjectiveName', 'asc')
                        ->get();//dd($sortByObjective);
    $checkAccomplishment = 0;
    foreach($sortByObjective as $measure)
    {
        $accomplishments = UnitTarget::with('unit_measure')
                                    ->with('unit_measure.unit_objective')
                                    ->with('unit_owner')
                                    ->with('unit_funding')
                                    ->with('unit_initiative')
                                    ->with('unit_accomplishment')
                                    ->with('user_unit')
                                    ->with('user_unit.rank')
                                    ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                    ->where('UnitID', '=', $unit->UnitID)
                                    ->where('UnitMeasureID', '=', $measure->UnitMeasureID)
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
    .label-primary 
    {
        background-color: #d9534f;
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
    <img class="unitlogo" src="{{URL::asset($unitlogoPath)}}" style="height: 120px;width: 120px;">
    <p style="text-align: center;">
        <normal style="font-size: 15px">Republic of the Philippines</normal>
        <br>
        <strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
        <br>
        <normal style="font-size: 15px">{{ $unit->UnitName }}</normal>
        <br>
        <normal style="font-size: 10px">usc.pulis.net</normal>
    </p>
    <p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $unit->UnitAbbreviation }} KPI for Q{{ $selectedQuarter }} {{ $selectedYear }}</p>
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
                $accomplishments = UnitTarget::with('unit_measure')
                                                ->with('unit_measure.unit_objective')
                                                ->with('unit_owner')
                                                ->with('unit_funding')
                                                ->with('unit_initiative')
                                                ->with('unit_accomplishment')
                                                ->with('user_unit')
                                                ->with('user_unit.rank')
                                                ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
                                                ->where('UnitID', '=', $unit->UnitID)
                                                ->where('UnitMeasureID', '=', $measure->UnitMeasureID)
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
                            {{ $accomplishment->unit_measure->UnitMeasureName }}
                            @if($accomplishment->unit_measure->StaffMeasureID > 0)
                                <br>
                                <span class="label label-primary">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                            @endif
                        </td>
                        @if($accomplishment->unit_measure->UnitMeasureType == 'LG')
                            <td style="background-color: #5cb85c;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #5cb85c;"></td>
                        @endif
                        <td style="vertical-align: top;text-align: left;">
                            {{ $accomplishment->unit_measure->UnitMeasureFormula }}
                        </td>
                        @if($selectedQuarter == '1')
                            {{-- JANUARY --}}
                            <td>
                                {{ round($accomplishment->JanuaryTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->JanuaryAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JanuaryTarget-$accomplishment->unit_accomplishment->JanuaryAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->JanuaryAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JanuaryTarget;
                                    $JanuaryPerformance = round(($accomplishment->unit_accomplishment->JanuaryAccomplishment / $accomplishment->JanuaryTarget) * 100, 2);
                                ?>
                                {{ round($JanuaryPerformance, 2) }}%
                            </td>
                            {{-- FEBRUARY --}}
                            <td>
                                {{ round($accomplishment->FebruaryTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->FebruaryAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->FebruaryTarget-$accomplishment->unit_accomplishment->FebruaryAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->FebruaryAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->FebruaryTarget;
                                    $FebruaryPerformance = round(($accomplishment->unit_accomplishment->FebruaryAccomplishment / $accomplishment->FebruaryTarget) * 100, 2);
                                ?>
                                {{ round($FebruaryPerformance, 2) }}%
                            </td>
                            {{-- MARCH --}}
                            <td>
                                {{ round($accomplishment->MarchTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->MarchAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->MarchTarget-$accomplishment->unit_accomplishment->MarchAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->MarchAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->MarchTarget;
                                    $MarchPerformance = round(($accomplishment->unit_accomplishment->MarchAccomplishment / $accomplishment->MarchTarget) * 100, 2);
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
                                {{ round($accomplishment->unit_accomplishment->AprilAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->AprilTarget-$accomplishment->unit_accomplishment->AprilAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->AprilAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->AprilTarget;
                                    $AprilPerformance = round(($accomplishment->unit_accomplishment->AprilAccomplishment / $accomplishment->AprilTarget) * 100, 2);
                                ?>
                                {{ round($AprilPerformance, 2) }}%
                            </td>
                            {{-- MAY --}}
                            <td>
                                {{ round($accomplishment->MayTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->MayAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->MayTarget-$accomplishment->unit_accomplishment->MayAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->MayAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->MayTarget;
                                    $MayPerformance = round(($accomplishment->unit_accomplishment->MayAccomplishment / $accomplishment->MayTarget) * 100, 2);
                                ?>
                                {{ round($MayPerformance, 2) }}%
                            </td>
                            {{-- JUNE --}}
                            <td>
                                {{ round($accomplishment->JuneTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->JuneAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JuneTarget-$accomplishment->unit_accomplishment->JuneAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->JuneAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JuneTarget;
                                    $JunePerformance = round(($accomplishment->unit_accomplishment->JuneAccomplishment / $accomplishment->JuneTarget) * 100, 2);
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
                                {{ round($accomplishment->unit_accomplishment->JulyAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->JulyTarget-$accomplishment->unit_accomplishment->JulyAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->JulyAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->JulyTarget;
                                    $JulyPerformance = round(($accomplishment->unit_accomplishment->JulyAccomplishment / $accomplishment->JulyTarget) * 100, 2);
                                ?>
                                {{ round($JulyPerformance, 2) }}%
                            </td>
                            {{-- AUGUST --}}
                            <td>
                                {{ round($accomplishment->AugustTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->AugustAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->AugustTarget-$accomplishment->unit_accomplishment->AugustAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->AugustAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->AugustTarget;
                                    $AugustPerformance = round(($accomplishment->unit_accomplishment->AugustAccomplishment / $accomplishment->AugustTarget) * 100, 2);
                                ?>
                                {{ round($AugustPerformance, 2) }}%
                            </td>
                            {{-- SEPTEMBER --}}
                            <td>
                                {{ round($accomplishment->SeptemberTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->SeptemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->SeptemberTarget-$accomplishment->unit_accomplishment->SeptemberAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->SeptemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->SeptemberTarget;
                                    $SeptemberPerformance = round(($accomplishment->unit_accomplishment->SeptemberAccomplishment / $accomplishment->SeptemberTarget) * 100, 2);
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
                                {{ round($accomplishment->unit_accomplishment->OctoberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->OctoberTarget-$accomplishment->unit_accomplishment->OctoberAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->OctoberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->OctoberTarget;
                                    $OctoberPerformance = round(($accomplishment->unit_accomplishment->OctoberAccomplishment / $accomplishment->OctoberTarget) * 100, 2);
                                ?>
                                {{ round($OctoberPerformance, 2) }}%
                            </td>
                            {{-- NOVEMBER --}}
                            <td>
                                {{ round($accomplishment->NovemberTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->NovemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->NovemberTarget-$accomplishment->unit_accomplishment->NovemberAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->NovemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->NovemberTarget;
                                    $NovemberPerformance = round(($accomplishment->unit_accomplishment->NovemberAccomplishment / $accomplishment->NovemberTarget) * 100, 2);
                                ?>
                                {{ round($NovemberPerformance, 2) }}%
                            </td>
                            {{-- DECEMBER --}}
                            <td>
                                {{ round($accomplishment->DecemberTarget, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->unit_accomplishment->DecemberAccomplishment, 2) }}
                            </td>
                            <td>
                                {{ round($accomplishment->DecemberTarget-$accomplishment->unit_accomplishment->DecemberAccomplishment, 2) }}
                            </td>
                            <td>
                                <?php
                                    $overallAccomplishment = $overallAccomplishment + $accomplishment->unit_accomplishment->DecemberAccomplishment;
                                    $overallTarget = $overallTarget + $accomplishment->DecemberTarget;
                                    $DecemberPerformance = round(($accomplishment->unit_accomplishment->DecemberAccomplishment / $accomplishment->DecemberTarget) * 100, 2);
                                ?>
                                {{ round($DecemberPerformance, 2) }}%
                            </td>
                        @endif
                        @if($accomplishment->unit_measure->UnitMeasureFormula == 'Summation')
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