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

//LARAVEL MODULES
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



	$selectedYear = Session::get('year', 'default');	

    $chief_id = Session::get('chief_user_id', 'default'); //get the UserChiefID stored in session.
    $chief_user = UserChief::where('UserChiefID', '=', $chief_id)
                            ->first();

    $chief = UserChief::where('UserChiefID', '=', $chief_id)->select('ChiefID')->lists('ChiefID'); //Get the Unit of the chief         
    $chief = Chief::where('ChiefID', '=', $chief_user->ChiefID)->first();

	$logoPath = 'img/pnp_logo2.png';
	$chieflogoPath = 'uploads/chiefpictures/cropped/'.$chief->PicturePath;
?>

<!DOCTYPE html>

<head>
    <title>Report | PNP</title>
    <style type="text/css">
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
    
    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('unit/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('unit/bower_components/morrisjs/morris.min.js') }}"></script>
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


    <div id="morris-area-chart"></div>

</body>

<script type="text/javascript">

     $(document).ready(function()
      {
        $('#morris-area-chart').empty();
          var year = "<?php echo $selectedYear ?>";
          var chief_id = "<?php echo $chief_id ?>";

          $.ajax({
              type: "POST",
              url: "../bargraphchief",
              headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
              data: {'year' : year, 'chief_id' : chief_id},
              success: function(response){
                var arr = response;
                Morris.Bar({
                element: 'morris-area-chart',
                data: [
                    {month: arr[0][0] , target: arr[0][1].toFixed(2) , accomp: arr[0][2].toFixed(2)},
                    {month: arr[1][0] , target: arr[1][1].toFixed(2) , accomp: arr[1][2].toFixed(2)},
                    {month: arr[2][0] , target: arr[2][1].toFixed(2) , accomp: arr[2][2].toFixed(2)},
                    {month: arr[3][0] , target: arr[3][1].toFixed(2) , accomp: arr[3][2].toFixed(2)},
                    {month: arr[4][0] , target: arr[4][1].toFixed(2) , accomp: arr[4][2].toFixed(2)},
                    {month: arr[5][0] , target: arr[5][1].toFixed(2) , accomp: arr[5][2].toFixed(2)},
                    {month: arr[6][0] , target: arr[6][1].toFixed(2) , accomp: arr[6][2].toFixed(2)},
                    {month: arr[7][0] , target: arr[7][1].toFixed(2) , accomp: arr[7][2].toFixed(2)},
                    {month: arr[8][0] , target: arr[8][1].toFixed(2) , accomp: arr[8][2].toFixed(2)},
                    {month: arr[9][0] , target: arr[9][1].toFixed(2) , accomp: arr[9][2].toFixed(2)},
                    {month: arr[10][0] , target: arr[10][1].toFixed(2) , accomp: arr[10][2].toFixed(2)},
                    {month: arr[11][0] , target: arr[11][1].toFixed(2) , accomp: arr[11][2].toFixed(2)}
                ],
                xkey: 'month',
                ykeys: ['target', 'accomp'],
                labels: ['Target', 'Accomplishment']
            });              }
          })
      });


</script>