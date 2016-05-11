@extends('layout-staff')

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
    <script src="{{ asset('app/controllers/staff_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APIStaffAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning">
                    <div class="col-lg-12 unitdashboard-custom-unit-activityname">
                        <i class="fa fa-bell fa-2x"></i></i> <h2><b> {{ $staff_user->staff->StaffName }} Activity Log</b></h2>
                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                    </div>

                     <div class="col-lg-12 unitdashboard-custom-unit-activityabb">
                        <i class="fa fa-bell fa-2x"></i></i> <h2><b>{{ $staff_user->staff->StaffAbbreviation }} Activity Log</b></h2>
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
                            Recent activities from {{ $staff_user->staff->StaffName }} </div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive" ng-show="info">
                            <table class="table table-bordered">
                                <thead>
                                    <td colspan="3" class="custom-audit-activity">Activity
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in staff_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td>
                                        <% audit_trail.user_staff.rank.RankCode%> 
                                        <% audit_trail.user_staff.UserStaffFirstName %>
                                        <% audit_trail.user_staff.UserStaffLastName %>
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