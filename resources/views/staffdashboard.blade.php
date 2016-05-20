@extends('layout-staff')

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

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/timeago.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_dashboard.js') }}"></script>
    
    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashname">
            <p><b>{{ $staff_user->staff->StaffName }} Staff Dashboard</b></p>
        </div>
        <div class="col-md-12"><br /></div>
    </div>

    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashabb">
            <img class="img-responsive dashboard-custom-pictureabb" 
                src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
            <p>
                <b>{{ $staff_user->staff->StaffAbbreviation }} Staff Dashboard</b>
            </p>
        </div>
        <div class="col-md-12"><br /></div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <center>
                <img class="img-responsive dashboard-custom-picture" src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
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
                                        <div class="huge">{{ $staff_objectives_count }}</div>
                                        <div>Objectives</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('staff/objectives') }}">
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
                                        <div class="huge">{{ $staff_measures_count }}</div>
                                        <div>Measures</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('staff/measures') }}">
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
                                <li>
                                    <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="fa fa-calendar fa-fw"></i>Launch demo modal</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="row">
                <div class="col-lg-6">
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
                                        <li><a href="#"><i class="fa fa-file-text fa-fw"></i> Choose Date</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-4x pull-right"></i>
                            <h4><b>PERFORMANCE THIS YEAR, QUARTERLY - (BY % PERCENTAGE)</b></h4>
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
            
            <div class="panel panel-warning" ng-app="unitScorecardApp" ng-controller="APIStaffAuditTrailsDashController" >
                <div class="panel-heading">
                    <i class="fa fa-bell fa-4x pull-right"></i>
                    <h3><b>ACTIVITY LOG</b></h3>
                    <center><i ng-show="loading" class="fa fa-spinner fa-spin"></i></center>
                </div>

                <div class="container-fluid" dir-paginate='audit_trail_dash in staff_audit_trails_dash|orderBy:"updated_at":true:sortKey:reverse|itemsPerPage:5'>
                <br />
                    <a href="#" class="list-group-item">
                        <i class="fa fa-tasks fa-fw"></i> 
                            <b><% audit_trail_dash.user_staff.rank.RankCode%> 
                                <% audit_trail_dash.user_staff.UserStaffFirstName %>
                                <% audit_trail_dash.user_staff.UserStaffLastName %>
                            </b> 
                            <br />
                            <% audit_trail_dash.Action %>
                        <br />
                        <span class="pull-right small"><% audit_trail_dash.updated_at |timeago %></span>
                        <br />
                    </a>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- /.list-group -->
                    <a href="{{ url('staff/audit_trails') }}" class="btn btn-default btn-block">View All Activity Logs</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-search fa-4x pull-right"></i>
                    <h4><b>BROWSE OTHER UNIT'S SCORECARD</b></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
           
        </div>
        <!-- /.col-lg-4 -->


<!-- /.bargraph date modal -->
<!-- Button to trigger modal -->

 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <div id="datetimepicker1" class="input-append date">
      <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
      <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>



    <!-- /.row -->



<script type="text/javascript">

  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

  $(document).ready(function()
  {

      //Unit Office dropdown
      $('#year').change(function()
      {


            $('#morris-area-chart').empty();

          var year = $('option:selected').val();
          var staff_id = "<?php echo $staff_id ?>";

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
                    {month: arr[0][0] , target: arr[0][1] , accomp: arr[0][2]},
                    {month: arr[1][0] , target: arr[1][1] , accomp: arr[1][2]},
                    {month: arr[2][0] , target: arr[2][1] , accomp: arr[2][2]},
                    {month: arr[3][0] , target: arr[3][1] , accomp: arr[3][2]},
                    {month: arr[4][0] , target: arr[4][1] , accomp: arr[4][2]},
                    {month: arr[5][0] , target: arr[5][1] , accomp: arr[5][2]},
                    {month: arr[6][0] , target: arr[6][1] , accomp: arr[6][2]},
                    {month: arr[7][0] , target: arr[7][1] , accomp: arr[7][2]},
                    {month: arr[8][0] , target: arr[8][1] , accomp: arr[8][2]},
                    {month: arr[9][0] , target: arr[9][1] , accomp: arr[9][2]},
                    {month: arr[10][0] , target: arr[10][1] , accomp: arr[10][2]},
                    {month: arr[11][0] , target: arr[11][1] , accomp: arr[11][2]}
                ],
                xkey: 'month',
                ykeys: ['target', 'accomp'],
                
                labels: ['target', 'accomplishments']
            });              }

          })
      });


    });



</script>

<script type="text/javascript">

$(function() {
  $('#datetimepicker1').datetimepicker({
    language: 'pt-BR'
  });
});

</script>


    

@endsection