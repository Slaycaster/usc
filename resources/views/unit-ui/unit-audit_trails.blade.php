@extends('layout-unit')

@section('content')
    
    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/timeago.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APIUnitAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning">
                    <div class="col-lg-12 unitdashboard-custom-unit-activity">
                        <i class="fa fa-bell fa-2x"></i></i> <h2><b>{{ $user->unit->UnitName }} Activity Log</b></h2>
                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                    </div>

                     <div class="col-lg-12 unitdashboard-custom-unit-activityabb">
                        <i class="fa fa-bell fa-2x"></i></i> <h2><b>{{ $user->unit->UnitAbbreviation  }} Activity Log</b></h2>
                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                    </div>
                       
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 pull-right">
                                <form>
                                    <div class="form-group">
                                    <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-search fa-fw"></i>
                                            </span>
                                            
                                            <input type="text" ng-model="search" class="form-control" placeholder="Search here...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/.div class row-->
                        <div class="row">
                            <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> 
                            Recent activities from {{ $user->unit->UnitName }}</div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive" ng-show="info">
                            <table class="table table-striped">
                                <thead>
                                    <td colspan="3"><b>Activity</b>
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in unit_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td><% audit_trail.user_unit.rank.RankCode%> 
                                        <% audit_trail.user_unit.UserUnitFirstName %>
                                        <% audit_trail.user_unit.UserUnitLastName %>
                                    </td>
                                    <td><% audit_trail.Action %></td>
                                    
                                    <td><% audit_trail.created_at | timeago %></td>
                                </tr>
                            </table>
                        </div>

                        <!--./table table striped-->
                        <center>
                            <dir-pagination-controls
                               max-size="7"
                               direction-links="true"
                               boundary-links="true" >
                            </dir-pagination-controls>
                            <!--./dir-pagination-controls-->
                        </center>
                    </div>
                </div>
            </div>
        </div>
     
@endsection