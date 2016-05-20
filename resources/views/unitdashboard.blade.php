@extends('layout-unit')

@section('content')

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('unit/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('unit/bower_components/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('unit/js/morris-data.js') }}"></script>

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

    <script src="{{ asset('app/cut.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_dashboard.js') }}"></script>
    
    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashname">
            <p><b>{{ $user->unit->UnitName }} Unit Dashboard</b></p>
        </div>
        <div class="col-md-12"><br /></div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 dashboard-custom-dashabb">
            <img class="img-responsive dashboard-custom-pictureabb" 
                src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
            <p>
                <b>{{ $user->unit->UnitAbbreviation }} Unit Dashboard</b>
            </p>
        </div>
        <div class="col-md-12"><br /></div>
    </div>
    
    <div class="row">
        <div class="col-lg-3">
            <center>
                <img class="img-responsive dashboard-custom-picture" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
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
                                        <div class="huge">{{ $unit_objectives_count }}</div>
                                        <div>Objectives</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('unit/objectives') }}">
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
                                        <div class="huge">{{ $unit_measures_count }}</div>
                                        <div>Measures</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('unit/measures') }}">
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
    <!-- /.unitpicture -->
    
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
                                        <li><a href="#"><i class="fa fa-calendar fa-fw"></i> Choose date...</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.panel-body -->
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
            
            <div class="panel panel-warning" ng-app="unitScorecardApp" ng-controller="APIUnitAuditTrailsDashController" >
                <div class="panel-heading">
                    <i class="fa fa-bell fa-4x pull-right"></i>
                    <h3><b>ACTIVITY LOG</b></h3>
                    <center><i ng-show="loading" class="fa fa-spinner fa-spin"></i></center>
                </div>

                <div class="container-fluid" dir-paginate='audit_trail_dash in unit_audit_trails_dash|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                <br />
                    <a href="{{ url('unit/audit_trails') }}" class="list-group-item">
                        <i class="fa fa-tasks fa-fw"></i> 
                            <b><% audit_trail_dash.user_unit.rank.RankCode%> 
                                <% audit_trail_dash.user_unit.UserUnitFirstName %>
                                <% audit_trail_dash.user_unit.UserUnitLastName %>
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
                    <a href="{{ url('unit/audit_trails') }}" class="btn btn-default btn-block">View All Activity Logs</a>
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
    </div>
    <!-- /.dashboard content -->

@endsection