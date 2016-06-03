@extends('layout-secondary')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/secondary_unit_objectives.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <br>
	<div ng-app="unitScorecardApp" ng-controller="APISecondaryUnitObjectiveController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning objectives-custom-panel">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $user->secondary_unit->SecondaryUnitAbbreviation }} Objectives</b>
                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Secondary Unit's Objective</button>
								</div>

								<div class="col-lg-5 pull-right">
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
								<div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i> Unit Objectives of {{ $user->secondary_unit->SecondaryUnitName }}.
                                </div>
                                <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i> Unit Objectives of {{ $user->secondary_unit->SecondaryUnitAbbreviation }}.
                                </div>
							</div>
							<!--./div class row-->
                            <div class="table-responsive" ng-show="info" id="tabledata">
    							<table class="table table-bordered">
    								<thead>
    									<td class="unit_objective-name">  
                                            Objective Name
    									</td>
    									<td class="unit_objective-perspective">
                                            Perspective
    									</td>
                                    <!-- 
                                        <td class="unit_objective-contributory">
                                            Contributory to Staff's Objective
                                        </td>
                                    -->
    									<td class="unit_objective-encoder">
                                            Last Encoded by
    									</td>
    									<td class="unit_objective-edit"></td>
    								</thead>
    								<tr dir-paginate='unit_objective in secondary_unit_objectives|orderBy: "updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% unit_objective.SecondaryUnitObjectiveName %></td>
    									<td><% unit_objective.perspective.PerspectiveName %></td>
                                    <!--
                                        <td><% unit_objective.staffobjective.StaffObjectiveName %></td>
    								-->
                                        <td>

                                            <div class="col-md-5">
                                                <center>
                                                   <img ng-src="../uploads/userpictures/secondary/cropped/<%unit_objective.user_secondary_unit.UserSecondaryUnitPicturePath%>" height="30px;" class="thumbnail">
                                                </center>
                                            </div>

                                            
                                            <div style="font-size:12px;">
                                            <% unit_objective.user_secondary_unit.rank.RankCode %> 
                                            <% unit_objective.user_secondary_unit.UserSecondaryUnitFirstName %> 
                                            <% unit_objective.user_secondary_unit.UserSecondaryUnitLastName %>
                                            </div>
                                        </div>
                                        </td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', unit_objective.SecondaryUnitObjectiveID)"><span class="fa fa-edit fa-fw"></button>
    										<!--<button class="btn btn-danger btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button>-->
    									</td>
    								</tr>
    							</table>
							<!--./table table striped-->
                            </div>
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

		<!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>

                    <div class="modal-body">
                        <form name="frmEditObjective" class="form-horizontal" novalidate="">
                            <table class="table table-responsive">
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="objective_name" class="control-label">Objective Name:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_objective_name" name="objective_name" value="<% unit_objective.SecondaryUnitObjectiveName %>" ng-model="unit_objective.SecondaryUnitObjectiveName" autocomplete="off" class="form-control" required ng-touched>
                                        <span class="help-inline" ng-show="userForm.objective_name.$invalid && !userForm.objective_name.$pristine">Objective Name is required.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="perspective_id" class="control-label">Perspective:</label>
                                    </td>
                                    <td class="col-md-8">
                                         <select id="id_perspective_id" name="perspective_id" data-ng-model="selectedUserProfile" class="form-control" data-ng-options="userprofile.PerspectiveName for userprofile in perspective" required ng-touched >
                                
                                        </select>

                                        <span ng-show="userForm.perspective_id.$invalid && !userForm.perspective_id.$pristine" class="help-inline">Perspective is required.</span>
                                    </td>
                                </tr>
                                <!--
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="staffobjective_id" class="control">Contributory to Staff Scorecard:</label>
                                    </td>
                                    <td class="col-md-8">
                                      
                                        <select id="id_staffobjective_id" name="staffobjective_id" data-ng-model="selectedStaffObjective" class="form-control" data-ng-options="obj.StaffObjectiveName for obj in staffobjective" required ng-touched>
                                    </td>
                                </tr>
                                -->
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="unit" class="control-label">Unit:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->secondary_unit->SecondaryUnitName }}</p>
                                        <input type="hidden" name="UnitID" value="<?=$user->secondary_unit->SecondaryUnitID?>" id="unit_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="accountUser" class="control-label">Account User:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->rank->RankCode }} {{ $user->UserSecondaryUnitFirstName }} {{ $user->UserSecondaryUnitLastName }} </p>
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserSecondaryUnitID?>" id="user_unit_id">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditObjective.$invalid">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
  

@endsection