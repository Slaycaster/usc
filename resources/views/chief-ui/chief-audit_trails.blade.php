@extends('layout-chief')

@section('content')
    
   <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/timeago.js') }}"></script>
    
    <!-- Audit Trail Scripts -->
    <script src="{{ asset('app/controllers/chief_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APIChiefAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning">
                    <div class="col-lg-12 unitdashboard-custom-unit-activitylogname">
                        <div  class="col-lg-8 col-md-offset-2">
                            <i class="fa fa-bell fa-2x"></i> <h2><b> {{ $chief_user->chief->ChiefName }} Activity Log</b></h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>

                     <div class="col-lg-12 unitdashboard-custom-unit-activitylogabb">
                        <i class="fa fa-bell fa-2x"></i> <h2><b>{{ $chief_user->chief->ChiefAbbreviation }} Activity Log</b></h2>
                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-5 pull-right">
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
                            Recent activities from {{ $chief_user->chief->ChiefName }} </div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive" ng-show="info">
                            <table class="table table-bordered">
                                <thead>
                                    <td colspan="3" class="custom-audit-activity">Activity
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in chief_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td>
                                        <% audit_trail.user_chief.rank.RankCode %> 
                                        <% audit_trail.user_chief.UserChiefFirstName %>
                                        <% audit_trail.user_chief.UserChiefLastName %>
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