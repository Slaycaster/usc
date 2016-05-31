@extends('layout-chief')

@section('content')

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('unit/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('unit/bower_components/morrisjs/morris.min.js') }}"></script>

    <!-- Slaycaster Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-all.css') }}">

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <script src="{{ asset('app/cut.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/timeago.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/chief_dashboard.js') }}"></script>
    
    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashname">
            <p><b>{{ $chief_user->chief->ChiefName }} Dashboard</b></p>
        </div>
        <div class="col-md-12"><br /></div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashabb">
            <img class="img-responsive dashboard-custom-pictureabb" 
                src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
            <p>
                <b>{{ $chief_user->chief->ChiefAbbreviation }} Dashboard</b>
            </p>
        </div>
        <div class="col-md-12"><br /></div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-3">
            <center>
                <img class="img-responsive dashboard-custom-picture" src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
            </center>
        </div>
        <div class="col-lg-9">
            <div class = "panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-link fa-4x pull-right"></i> 
                    <h3><b>SCORECARD COMPONENTS</b></h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-circle-o-notch fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $chief_objectives_count }}</div>
                                        <div>Objectives</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('chief/objectives')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to Objectives</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $chief_measures_count }}</div>
                                        <div>Measures</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('chief/measures') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to Measures</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-line-chart fa-4x pull-right"></i> 
                    <h3><b>ACCOMPLISHMENT - MONTHLY ACCUMULATION SUMMARY</b></h3>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#"><i class="fa fa-list fa-fw"></i> Hide/Show</a>
                                </li>
                                <li><a href="#"><i class="fa fa-file-text fa-fw"></i> Export to PDF</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-calendar fa-fw"></i> Choose date...</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.panel -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-4x pull-right"></i> 
                            <h4><b>TARGET VS. ACCOMPLISHMENTS - MONTHLY SUMMARY</b></h4>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                   <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#"><i class="fa fa-list fa-fw"></i> Hide/Show</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-file-text fa-fw"></i> Export to PDF</a>
                                        </li>
                                        <li class="divider"></li>
                                         <li>
                                    <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="fa fa-calendar fa-fw"></i>Choose Date</a>
                                </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="table table-responsive">
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-4x pull-right"></i>
                            <h4><b>PERFORMANCE THIS YEAR, QUARTERLY - (BY % PERCENTAGE)</b></h4>
                              <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                   <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#"><i class="fa fa-list fa-fw"></i> Hide/Show</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-file-text fa-fw"></i> Export to PDF</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                    <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="fa fa-calendar fa-fw"></i>Choose Date</a>
                                </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            
            <div class="panel panel-warning" ng-app="unitScorecardApp" ng-controller="APIChiefAuditTrailsDashController" >
                <div class="panel-heading">
                    <i class="fa fa-bell fa-4x pull-right"></i>
                    <h3><b>ACTIVITY LOG</b></h3>
                    <center><i ng-show="loading" class="fa fa-spinner fa-spin"></i></center>
                </div>

                <div class="list-group" dir-paginate='audit_trail_dash in chief_audit_trails_dash|orderBy:"updated_at":true:sortKey:reverse|itemsPerPage:5'>
                    <!-- <a href="{{ url('staff/audit_trails') }}" class="list-group-item"> -->
                    <a href="{{ url('chief/audit_trails') }}" class="list-group-item" style="font-size:12px;">
                    <span class="pull-right"><img ng-src="../uploads/userpictures/unit/cropped/<%audit_trail_dash.user_chief.UserChiefPicturePath%>" height="30px;">
                    </span>  

                            <b><% audit_trail_dash.user_chief.rank.RankCode%> 
                                <% audit_trail_dash.user_chief.UserChiefFirstName %>
                                <% audit_trail_dash.user_chief.UserChiefLastName %>
                            </b> 
                            <br />
                            <% audit_trail_dash.Action | cut:true:75:' ...' %>
                        <br />
                        <span class="pull-right small"><% audit_trail_dash.updated_at |timeago %></span>
                        <br />
                    </a>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- /.list-group -->
                    <a href="{{ url('chief/audit_trails') }}" class="btn btn-default btn-block">View All Activity Logs</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

          
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-search fa-4x pull-right"></i>
                    <h4><b>BROWSE OTHER UNIT/STAFF'S SCORECARD</b></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search..." id="unitsearch" onkeydown="down()" onkeyup="up()">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->

                    <!-- /search results -->
                    <div class="list-group" id="searchresults">
                        
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
           
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->




    <!-- /.bargraph date modal -->
<!-- Button to trigger modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Choose Year</h4>

            </div>
            <div class="modal-body">
              

                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.row -->


<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

  $(document).ready(function()
  {
     $("#datetimepicker1").on("dp.change", function(e) {
        
        $('#morris-area-chart').empty();

          var year = $("#datetimepicker1").find("input").val();
          console.log(year);
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
            });              
            }})
        });
    });


</script>



<script type="text/javascript">

     $(document).ready(function()
      {
        $('#morris-area-chart').empty();
          var year = new Date().getFullYear()
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






<!-- Morris donut chart on date change-->
<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

  $(document).ready(function()
  {


     $("#datetimepicker1").on("dp.change", function(e) {
            
        
        $('#morris-donut-chart').empty();

          var year = $("#datetimepicker1").find("input").val();
          var chief_id = "<?php echo $chief_id ?>";

          $.ajax({
              type: "POST",
              url: "../donutgraphchief",
              headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
              data: {'year' : year, 'chief_id' : chief_id},
              success: function(response){
                var arr = response;
                Morris.Donut({
                  element: 'morris-donut-chart',
                  data: [
                    {label: "1st Quarter", value: arr[0]},
                    {label: "2nd Quarter", value: arr[1]},
                    {label: "3rd Quarter", value: arr[2]},
                    {label: "4th Quarter", value: arr[3]}
                  ]
                });     

              }

          })
   });


   


 });



</script>




<script type="text/javascript">
    $(function () {
       $('#datetimepicker1').datetimepicker({
        viewMode: 'years',
        format: 'YYYY',
        useCurrent: true
        });
    });
</script>

<script type="text/javascript">

var timer;
function up()
{
    timer = setTimeout(function()
    {
        var search = $('#unitsearch').val();
        $("#searchresults").empty();
        $.ajax({
                  type: "POST",
                  url: "../searchunit",
                  headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
                  data: {'search' : search},
                  success: function(response){
                    console.log(response);
                    $("#searchresults").empty();
                    var unit = response.u ;
                    var staff = response.s ;
                    var i;
                    var div = document.getElementById("searchresults");
                    for(i = 0; i < unit.length; i++) 
                    {
                        var a = document.createElement('a');
                        var img = document.createElement('img');
                        var h4 = document.createElement('h4');
                        var p = document.createElement('p');
                        var span = document.createElement('span');
                        
                        if(unit[i].UnitName != null)
                        {
                            var id = unit[i].UnitID;
                            var picture = unit[i].PicturePath;
                            var picture_path = "{{ asset('uploads/unitpictures/cropped') }}"+"/"+picture;

                            a.setAttribute("href", "{{ url('report/currentYearChiefUnitScorecard') }}"+'/'+id);
                            a.setAttribute("class", "list-group-item clearfix");
                            a.target = "_blank";

                            /*SET PICTURE THUMBNAIL*/
                            img.setAttribute("src", picture_path);
                            img.style.width = "32px";
                            img.style.height = "32px";

                            //Append UnitName/UnitAbbreviation
                            h4.setAttribute("class", "list-group-item-heading");
                            h4.appendChild(document.createTextNode(unit[i].UnitAbbreviation+' - '+unit[i].UnitName));

                            p.setAttribute("class", "list-group-item-text");
                            p.appendChild(document.createTextNode("Scorecard Report"));

                            span.setAttribute("class", "pull-right");
                            span.appendChild(img);

                            a.appendChild(span);
                            a.appendChild(h4);
                            a.appendChild(p);

                            div.appendChild(a);       
                        }
                    }

                    for(i = 0; i < staff.length; i++) 
                    {
                        var a = document.createElement('a');
                        var img = document.createElement('img');
                        var h4 = document.createElement('h4');
                        var p = document.createElement('p');
                        var span = document.createElement('span');

                        if(staff[i].StaffName != null)
                        {   
                            var id = staff[i].StaffID;
                            var picture = staff[i].PicturePath;
                            var picture_path = "{{ asset('uploads/staffpictures/cropped') }}"+"/"+picture;

                            a.setAttribute("href", "{{ url('report/currentYearChiefStaffScorecard') }}"+'/'+id);
                            a.setAttribute("class", "list-group-item clearfix");
                            a.target = "_blank";

                            /*SET PICTURE THUMBNAIL*/
                            img.setAttribute("src", picture_path);
                            img.style.width = "32px";
                            img.style.height = "32px";

                            //Append StaffName/StaffAbbreviation
                            h4.setAttribute("class", "list-group-item-heading");
                            h4.appendChild(document.createTextNode(staff[i].StaffAbbreviation+' - '+staff[i].StaffName));

                            p.setAttribute("class", "list-group-item-text");
                            p.appendChild(document.createTextNode("Scorecard Report"));

                            span.setAttribute("class", "pull-right");
                            span.appendChild(img);

                            a.appendChild(span);
                            a.appendChild(h4);
                            a.appendChild(p);

                            div.appendChild(a);      
                        }
                    }

                     div.setAttribute("style","height:300px; overflow-x:scroll; overflow-x:hidden")
                }

        }) 
    }, 1000);
}

function down()
{
    clearTimeout(timer);
}

</script>    

@endsection