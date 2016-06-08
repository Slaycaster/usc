@extends('layout-tertiary-unit')

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
    <script src="{{ asset('app/controllers/tertiary_unit_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning audit-custom-panel">
                    <div class="col-lg-12 dashboard-custom-activitylogname">
                        <div  class="col-lg-8 col-md-offset-2">
                            <i class="fa fa-bell fa-2x"></i> <h2><b> {{ $chief_user->tertiary_unit->TertiaryUnitName }} Activity Log</b></h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>

                     <div class="col-lg-12 dashboard-custom-activitylogabb">
                        <i class="fa fa-bell fa-2x"></i> <h2><b>{{ $chief_user->tertiary_unit->TertiaryUnitAbbreviation }} Activity Log</b></h2>
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
                            <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i> 
                            Recent activities from {{ $chief_user->tertiary_unit->TertiaryUnitName }} </div>
                            <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i> 
                            Recent activities from {{ $chief_user->tertiary_unit->TertiaryUnitAbbreviation }} </div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive" ng-show="info">
                            <table class="table table-bordered">
                                <thead>
                                    <td colspan="3">
                                        Activity
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in tertiary_unit_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td class="audit-encoder">
                                     <div class="col-md-5">
                                            <center>
                                                <img ng-src="../uploads/userpictures/unit/cropped/<%audit_trail.user_tertiary.UserTertiaryUnitPicturePath%>" height="30px;" class="thumbnail">
                                            </center>
                                        </div>

                                        <div style="font-size:12px;">
                                            <% audit_trail.user_tertiary.rank.RankCode %> 
                                            <% audit_trail.user_tertiary.UserTertiaryUnitFirstName %>
                                            <% audit_trail.user_tertiary.UserTertiaryUnitLastName %>
                                        </div>
                                    </td>
                                    <td class="audit-action">
                                        <% audit_trail.Action %>
                                    </td>
                                    <td class="audit-time">
                                        <% audit_trail.created_at | timeago %>
                                    </td>
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
    </div>
     
@endsection