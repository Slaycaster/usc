@extends('layout-unit')

@section('content')
    
    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APIUnitAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning">
                    <div class="col-lg-12 unitdashboard-custom-unit-activity">
                        <i class="fa fa-bell fa-2x"></i><p class="page-header"><b>{{ $user->unit->UnitName }} Activity Log</b></p>
                    </div>

                     <div class="col-lg-12 unitdashboard-custom-unit-activityabb">
                        <i class="fa fa-bell fa-2x"></i><p class="page-header"><b>{{ $user->unit->UnitAbbreviation }} Activity Log</b></p>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <!-- <div class="col-lg-4">
                                <button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Unit's Measure</button>
                            </div> -->
                            <div class="col-lg-6 pull-right">
                                <form>
                                    <div class="form-group">
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
                            <div class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> Click on the table's column in order to sort ascending or descending.</div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <td ng-click="sort('audit_trail.Action ')"><b>Action</b>
                                        <span class="glyphicon sort-icon" ng-show="sortKey=='audit_trail.Action'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                    </td>

                                    <td ng-click="sort('audit_trail.user_unit.UserUnitLastName')"><b>Last Encoded By</b>
                                        <span class="glyphicon sort-icon" ng-show="sortKey=='audit_trail.created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                    </td>

                                    </td>
                                    <td ng-click="sort(' audit_trail.created_at ')"><b>Created at</b>
                                        <span class="glyphicon sort-icon" ng-show="sortKey=='audit_trail.created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                    </td>
                                    <td ng-click="sort(' audit_trail.updated_at ')"><b>Updated at</b>
                                        <span class="glyphicon sort-icon" ng-show="sortKey=='audit_trail.updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in unit_audit_trails|orderBy:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td><% audit_trail.Action %></td>
                                    <td><% audit_trail.user_unit.rank.RankCode%> 
                                        <% audit_trail.user_unit.UserUnitFirstName %>
                                        <% audit_trail.user_unit.UserUnitLastName %>
                                        </td>
                                    <td><% audit_trail.created_at %></td>
                                    <td><% audit_trail.updated_at %></td>
                                </tr>
                            </table>
                        </div>

                        <!--./table table striped-->
                        <center>
                            <dir-pagination-controls
                               max-size="5"
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