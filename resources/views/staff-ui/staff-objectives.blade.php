@extends('layout-staff')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_objectives.js') }}"></script>

    <br>
	<div ng-app="unitScorecardApp" ng-controller="APIStaffObjectiveController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $staff_user->staff->StaffAbbreviation }} Objectives</b></h2><i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Staff's Objective</button>
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
								<div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> Staff Objectives of {{ $staff_user->Staff->StaffName }}.</div>
							</div>
							<!--./div class row-->
                            <div class="table-responsive" ng-show="info">
    							<table class="table table-bordered">
    								<thead>
    									
                                        <td class="objective-custom-td1" ng-click="sort('staff_objective.StaffObjectiveName')">Staff Objective Name
                                            <span class="glyphicon sort-icon" ng-show="sortKey=='staff_objective.StaffObjectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                        </td>

                                        <td class="objective-custom-td2" ng-click="sort('staff_objective.perspective.PerspectiveName')">Perspective
                                            <span class="glyphicon sort-icon" ng-show="sortKey=='staff_objective.perspective.PerspectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                        </td>
                                        
                                        <td class="objective-custom-td3" ng-click="sort('staff_objective.chief_objective.ChiefObjectiveName')">Contributory to
                                            <span class="glyphicon sort-icon" ng-show="sortKey=='staff_objective.chief_objective.ChiefObjectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                                        </td>


    									<td class="objective-custom-td4" ng-click="sort('staff_objective.staff.StaffAbbreviation')">Staff
    										<span class="glyphicon sort-icon" ng-show="sortKey=='staff_objective.staff.StaffAbbreviation'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td5" ng-click="sort('staff_objective.user_staff.rank.RankCode')">Last Encoded by
    										<span class="glyphicon sort-icon" ng-show="sortKey=='staff_objective.user_staff.rank.RankCode'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td6"></td>
    								</thead>
    								<tr dir-paginate='staff_objective in staff_objectives|orderBy: "updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% staff_objective.StaffObjectiveName %></td>
    									<td><% staff_objective.perspective.PerspectiveName %></td>
                                        <td><% staff_objective.chief_objective.ChiefObjectiveName %></td>
    									<td><% staff_objective.staff.StaffAbbreviation %></td>
    									<td><% staff_objective.user_staff.rank.RankCode %> <% staff_objective.user_staff.UserStaffName %> <% staff_objective.user_staff.UserStaffLastName %></td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', staff_objective.StaffObjectiveID)"><span class="fa fa-edit fa-fw"></button>
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
                                        <input type='text' id="id_objective_name" name="objective_name" value="<% staff_objective.StaffObjectiveName %>" ng-model="staff_objective.StaffObjectiveName" autocomplete="off" class="form-control" required ng-touched>
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

                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="staffobjective_id" class="control">Contributory to Chief Scorecard:</label>
                                    </td>
                                    <td class="col-md-8">
                                       

                                        <select id="id_chiefobjective_id" name="staffobjective_id" data-ng-model="selectedChiefObjective" class="form-control" data-ng-options="obj.ChiefObjectiveName for obj in chiefobjective" required ng-touched>
                                          
                                        </select>

                                    </td>
                                </tr>

                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="inputEmail3" class="control-label">Staff:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $staff_user->staff->StaffName }}</p>
                                        <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="inputEmail3" class="control-label">Account User:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $staff_user->rank->RankCode }} {{ $staff_user->UserStaffFirstName }} {{ $staff_user->UserStaffLastName }} </p>
                                        <input type="hidden" name="UserStaffID" value="<?=$staff_user->UserStaffID?>" id="user_staff_id">
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