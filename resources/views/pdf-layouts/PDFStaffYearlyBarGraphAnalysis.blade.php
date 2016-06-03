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
?>

<!DOCTYPE html>

<head>
    <title>Report | PNP</title>
    <style type="text/css">
    table
    {
        font-size: 14;
        text-align: center;
        border-collapse: collapse;
        page-break-inside: auto;
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
        left: 85%;
        top: 16px;
    }
    #tar,#tar1,#tar2,#tar3,#tar4,#tar5,#tar6,#tar7,#tar8,#tar9,#tar10,#tar11,#tar12
    {
         color: #0B62A4;
         font-size: 14px;
         font-weight: bold;
    }
    #acc,#acc1,#acc2,#acc3,#acc4,#acc5,#acc6,#acc7,#acc8,#acc9,#acc10,#acc11,#acc12
    {
        color: #7a92a3;
        font-size: 14px;
        font-weight: bold;
    }
    </style>
    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('unit/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('unit/bower_components/morrisjs/morris.js') }}"></script>
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


    <div id="morris-area-chart"></div>
    <div>
        <table border=1 width="100%">
            <tr>
                <td width="12.4%"></td>
                <td width="7.3%">
                    January
                </td>
                <td width="7.3%">
                    February
                </td>
                <td width="7.3%">
                    March
                </td>
                <td width="7.3%">
                    April
                </td>
                <td width="7.3%">
                    May
                </td>
                <td width="7.3%">
                    June
                </td>
                <td width="7.3%">
                    July
                </td>
                <td width="7.3%">
                    August
                </td>
                <td width="7.3%">
                    September
                </td>
                <td width="7.3%">
                    October
                </td>
                <td width="7.3%">
                    November
                </td>
                <td width="7.3%">
                    December
                </td>
            </tr>
            <tr>
                <td id="tar"><p>Target</p></td>
                <td>
                    <p id="tar1"></p>
                </td>
                <td>
                    <p id="tar2"></p>
                </td>
                <td>
                    <p id="tar3"></p>
                </td>
                <td>
                    <p id="tar4"></p>
                </td>
                <td>
                    <p id="tar5"></p>
                </td>
                <td>
                    <p id="tar6"></p>
                </td>
                <td>
                    <p id="tar7"></p>
                </td>
                <td>
                    <p id="tar8"></p>
                </td>
                <td>
                    <p id="tar9"></p>
                </td>
                <td>
                    <p id="tar10"></p>
                </td>
                <td>
                    <p id="tar11"></p>
                </td>
                <td>
                    <p id="tar12"></p>
                </td>
            </tr>
            <tr>
                <td id="acc"><p>Accomplishment</p></td>
                <td>
                    <p id="acc1"></p>
                </td>
                <td>
                    <p id="acc2"></p>
                </td>
                <td>
                    <p id="acc3"></p>
                </td>
                <td>
                    <p id="acc4"></p>
                </td>
                <td>
                    <p id="acc5"></p>
                </td>
                <td>
                    <p id="acc6"></p>
                </td>
                <td>
                    <p id="acc7"></p>
                </td>
                <td>
                    <p id="acc8"></p>
                </td>
                <td>
                    <p id="acc9"></p>
                </td>
                <td>
                    <p id="acc10"></p>
                </td>
                <td>
                    <p id="acc11"></p>
                </td>
                <td>
                    <p id="acc12"></p>
                </td>
            </tr>   
        </table> 
    </div>

</body>

<script type="text/javascript">

     $(document).ready(function()
      {
        $('#morris-area-chart').empty();
          var year = "<?php echo $selectedYear ?>";
          var staff_id = "<?php echo $staff_user->StaffID ?>";

          $.ajax({
              type: "POST",
              url: "../bargraph",
              headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
              data: {'year' : year, 'staff_id' : staff_id},
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
                });
                var tar1 = document.getElementById("tar1");
                var tar2 = document.getElementById("tar2");
                var tar3 = document.getElementById("tar3");
                var tar4 = document.getElementById("tar4");
                var tar5 = document.getElementById("tar5");
                var tar6 = document.getElementById("tar6");
                var tar7 = document.getElementById("tar7");
                var tar8 = document.getElementById("tar8");
                var tar9 = document.getElementById("tar9");
                var tar10 = document.getElementById("tar10");
                var tar11 = document.getElementById("tar11");
                var tar12 = document.getElementById("tar12");
                var acc1 = document.getElementById("acc1");
                var acc2 = document.getElementById("acc2");
                var acc3 = document.getElementById("acc3");
                var acc4 = document.getElementById("acc4");
                var acc5 = document.getElementById("acc5");
                var acc6 = document.getElementById("acc6");
                var acc7 = document.getElementById("acc7");
                var acc8 = document.getElementById("acc8");
                var acc9 = document.getElementById("acc9");
                var acc10 = document.getElementById("acc10");
                var acc11 = document.getElementById("acc11");
                var acc12 = document.getElementById("acc12");

                tar1.appendChild(document.createTextNode(arr[0][1].toFixed(2)));
                tar2.appendChild(document.createTextNode(arr[1][1].toFixed(2)));
                tar3.appendChild(document.createTextNode(arr[2][1].toFixed(2)));
                tar4.appendChild(document.createTextNode(arr[3][1].toFixed(2)));
                tar5.appendChild(document.createTextNode(arr[4][1].toFixed(2)));
                tar6.appendChild(document.createTextNode(arr[5][1].toFixed(2)));
                tar7.appendChild(document.createTextNode(arr[6][1].toFixed(2)));
                tar8.appendChild(document.createTextNode(arr[7][1].toFixed(2)));
                tar9.appendChild(document.createTextNode(arr[8][1].toFixed(2)));
                tar10.appendChild(document.createTextNode(arr[9][1].toFixed(2)));
                tar11.appendChild(document.createTextNode(arr[10][1].toFixed(2)));
                tar12.appendChild(document.createTextNode(arr[11][1].toFixed(2)));
                acc1.appendChild(document.createTextNode(arr[0][2].toFixed(2)));
                acc2.appendChild(document.createTextNode(arr[1][2].toFixed(2)));
                acc3.appendChild(document.createTextNode(arr[2][2].toFixed(2)));
                acc4.appendChild(document.createTextNode(arr[3][2].toFixed(2)));
                acc5.appendChild(document.createTextNode(arr[4][2].toFixed(2)));
                acc6.appendChild(document.createTextNode(arr[5][2].toFixed(2)));
                acc7.appendChild(document.createTextNode(arr[6][2].toFixed(2)));
                acc8.appendChild(document.createTextNode(arr[7][2].toFixed(2)));
                acc9.appendChild(document.createTextNode(arr[8][2].toFixed(2)));
                acc10.appendChild(document.createTextNode(arr[9][2].toFixed(2)));
                acc11.appendChild(document.createTextNode(arr[10][2].toFixed(2)));
                acc12.appendChild(document.createTextNode(arr[11][2].toFixed(2)));
                //acc1.appendChild(p);
              }
          })
      });


</script>