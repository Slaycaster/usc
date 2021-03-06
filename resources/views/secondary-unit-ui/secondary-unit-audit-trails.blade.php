@extends('layout-secondary')

@section('content')
    
   <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/timeago.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>
    
    <!-- Audit Trail Scripts -->
    <script src="{{ asset('app/controllers/secondary_unit_audit_trails.js') }}"></script>

    <br />
    <div ng-app="unitScorecardApp" ng-controller="APISecondaryUnitAuditTrailsController">
        <div class="wrap">
            <div class="row">           
                <div class="panel panel-warning audit-custom-panel">
                    <div class="col-lg-12 dashboard-custom-activitylogname">
                        <div  class="col-lg-8 col-md-offset-2">
                            <i class="fa fa-bell fa-2x"></i> <h2><b> {{ $user->secondary_unit->SecondaryUnitName }} Activity Log</b></h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>

                     <div class="col-lg-12 dashboard-custom-activitylogabb">
                        <i class="fa fa-bell fa-2x"></i> <h2><b>{{ $user->secondary_unit->SecondaryUnitAbbreviation }} Activity Log</b></h2>
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
                        <div class="row" id="tableinfo">
                            <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i> 
                            Recent activities from {{ $user->secondary_unit->SecondaryUnitName }} </div>
                            <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i> 
                            Recent activities from {{ $user->secondary_unit->SecondaryUnitAbbreviation }} </div>
                        </div>
                        <!--./div class row-->

                        <div class="table-responsive" ng-show="info" id="tabledata"> 
                            <table class="table table-bordered">
                                <thead>
                                    <td colspan="3">
                                        Activity
                                    </td>
                                </thead>
                                <tr dir-paginate='audit_trail in secondary_unit_audit_trails|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <td class="audit-encoder">
                                     <div class="col-md-5">
                                            <center>
                                                <img ng-src="../uploads/userpictures/unit/cropped/<%audit_trail.user_secondary.UserSecondaryUnitPicturePath%>" height="30px;" class="thumbnail">
                                            </center>
                                        </div>

                                        <div style="font-size:12px;">
                                            <% audit_trail.user_secondary.rank.RankCode %> 
                                            <% audit_trail.user_secondary.UserSecondaryUnitFirstName %>
                                            <% audit_trail.user_secondary.UserSecondaryUnitLastName %>
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
                               boundary-links="true" 
                               id="pagina">
                            </dir-pagination-controls>
                            <!--./dir-pagination-controls-->
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showTableData() {
          // var reportbutton = document.getElementById("reportbutton").style.display = "block";
          var tableinfo = document.getElementById("tableinfo").style.display = "block";
          var tabledata = document.getElementById("tabledata").style.display = "block";
          var pagina = document.getElementById("pagina").style.display = "block";
        }
        setTimeout("showTableData()", 700);

    </script>
     
@endsection