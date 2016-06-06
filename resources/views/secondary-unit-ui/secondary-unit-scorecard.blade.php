@extends('layout-secondary')    
@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <script src="{{ asset('js/stickyheader.js') }}"></script>

    <script src="{{ asset('js/debounce.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stickyheader.css') }}">
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_scorecard.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>
    
    <div ng-app="unitScorecardApp" ng-controller="APIUnitScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">

                          
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->secondary_unit->PicturePath.'') }}">
                          
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $user->secondary_unit->SecondaryUnitAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            

                                <div class="col-md-3 pull-right">
                                    <a href="{{ url('report/currentYearSecondaryUnitScorecard') }}" target="_blank">
                                        <button type="button" class="btn btn-warning btn-sm pull-right" ><i class="fa fa-save fa-fw"></i>Generate Report</button>

                                    </a> 
                                </div>

                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            <div class="custom_scorecard-info" id="tableinfo">
                                <i ng-show="info"><span class="fa fa-list fa-fw"></span> Accomplishment last updated by: <b><% updatedby.user_unit.rank.RankCode %> <% updatedby.user_unit.UserUnitLastName %>, <% updatedby.user_unit.UserUnitFirstName %> on 
                                    <% updatedby.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-user fa-fw"></span> Owner last updated by: <b><% updatedby2.user_unit.rank.RankCode %> <% updatedby2.user_unit.UserUnitLastName %>, <% updatedby2.user_unit.UserUnitFirstName %> on 
                                    <% updatedby2.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br>
                                <i ng-show="info"><span class="fa fa-sitemap fa-fw"></span> Initiative last updated by: <b><% updatedby3.user_unit.rank.RankCode %> <% updatedby3.user_unit.UserUnitLastName %>, <% updatedby3.user_unit.UserUnitFirstName %> on 
                                    <% updatedby3.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-money fa-fw"></span> Funding last updated by: <b><% updatedby4.user_unit.rank.RankCode %> <% updatedby4.user_unit.UserUnitLastName %>, <% updatedby4.user_unit.UserUnitFirstName %> on 
                                    <% updatedby4.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i>        
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>

                            </div>

                        </div><!--div panel-heading-->


                        <div class="panel-body">
                            <div class="table-responsive tabledata" id="tabledata">
                                
                            </div>
                        </div><!-- div panel-body-->
                </div><!--div panel panel-info-->
            </div>
        </div>
    </div>

@endsection