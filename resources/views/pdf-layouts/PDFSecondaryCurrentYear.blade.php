<?php
	
//Freelance Models
use App\UserSecondaryUnit;
use App\SecondaryUnit;
use App\SecondaryUnitObjective;
use App\SecondaryUnitMeasure;
use App\SecondaryUnitAccomplishment;

	$selectedYear = Session::get('year', 'default');	

 	$secondary_unit_id = Session::get('secondary_id', 'default');
    $user = UserSecondaryUnit::where('SecondaryUnitID', $secondary_unit_id)
                ->with('secondary_unit')
                ->first();//dd($user);
    $secondary_unit = SecondaryUnit::where('SecondaryUnitID', '=', $user->SecondaryUnitID)->first();

	$logoPath = 'img/pnp_logo2.png';
	$secondaryunitlogoPath = 'uploads/secondaryunitpictures/cropped/'.$secondary_unit->PicturePath;
    $tempObjective = '';


    $sortByObjective = DB::table('secondary_unit_objectives')
                        ->join('secondary_unit_measures', 'secondary_unit_objectives.SecondaryUnitObjectiveID', '=', 'secondary_unit_measures.SecondaryUnitObjectiveID')
                        ->where('secondary_unit_objectives.SecondaryUnitID', '=', $secondary_unit->SecondaryUnitID)
                        ->orderBy('secondary_unit_objectives.SecondaryUnitObjectiveName', 'asc')
                        ->get();//dd($unit->UnitID);
    $checkAccomplishment = 0;
    // foreach($sortByObjective as $measure)
    // {
    //     $accomplishments = UnitTarget::with('unit_measure')
    //                                 ->with('unit_measure.unit_objective')
    //                                 ->with('unit_owner')
    //                                 ->with('unit_funding')
    //                                 ->with('unit_initiative')
    //                                 ->with('unit_accomplishment')
    //                                 ->with('user_unit')
    //                                 ->with('user_unit.rank')
    //                                 ->whereBetween('TargetDate', array($selectedYear.'-01-01', $selectedYear.'-12-31'))
    //                                 ->where('UnitID', '=', $unit->UnitID)
    //                                 ->where('UnitMeasureID', '=', $measure->UnitMeasureID)
    //                                 ->get();
    //     foreach ($accomplishments as $accomplishment)
    //     {
    //         //dd($accomplishment);
    //     }
    //     //dd($accomplishments);
    //     if(count($accomplishments) != 0)
    //     {
    //         $checkAccomplishment = $checkAccomplishment + 1;
    //     }
    // } 
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
	<img class="unitlogo" src="{{URL::asset($secondaryunitlogoPath)}}" style="height: 120px;width: 120px;">
	<p style="text-align: center;">
		<normal style="font-size: 15px">Republic of the Philippines</normal>
		<br>
		<strong>NATIONAL POLICE COMMISSION<br>PHILIPPINE NATIONAL POLICE</strong>
		<br>
		<normal style="font-size: 15px">{{ $secondary_unit->SecondaryUnitName }}</normal>
		<br>
		<normal style="font-size: 10px">usc.pulis.net</normal>
	</p>
	<p style="font-size: 14;font-family: helvetica;font-weight: 600;text-align: center;">{{ $secondary_unit->SecondaryUnitAbbreviation }} Scorecard for {{ $selectedYear }}</p>
    <table border="1">
        {{-- @if(count($accomplishments) != 0) --}}
            <thead style="font-weight: bold;font-family: arial,helvetica">
                <tr>
                    <td width="53" rowspan="2">OBJECTIVES</td>
                    <td colspan="3" style="text-align: left;padding-left: 3px;">MEASURES</td>
                    <td width="83" rowspan="2" style="text-align: left;padding-left: 3px;">OWNER</td>
                    <td colspan="12" height="12">TARGET/ACCOMPLISHMENT</td>
                    <td rowspan="2" style="text-align: left;padding-left: 3px;">INITIATIVES</td>
                    <td colspan="3">FUNDING</td>
                </tr>
                <tr>
                    <td width="88" style="text-align: left;padding-left: 3px;">Name</td>
                    <td width="15">LG</td>
                    <td width="15">LD</td>
                    <td width="30">Jan</td>
                    <td width="30">Feb</td>
                    <td width="30">Mar</td>
                    <td width="30">Apr</td>
                    <td width="30">May</td>
                    <td width="30">Jun</td>
                    <td width="30">Jul</td>
                    <td width="30">Aug</td>
                    <td width="30">Sep</td>
                    <td width="30">Oct</td>
        			<td width="30">Nov</td>
        			<td width="30">Dec</td>
                    <td width="32">Estimate</td>
                    <td width="28">Actual</td>
                    <td width="32">Variance</td>
                </tr>	
            </thead>
        {{-- @endif --}}

    </table>
</body>