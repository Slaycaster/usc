@extends('layout-chief')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <!-- AngularJS Application Script -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Chief Objective Controller Script -->
    <script src="{{ asset('app/controllers/chief_objectives.js') }}"></script>

    <br>
	<div ng-app="unitScorecardApp" ng-controller="APIChiefObjectiveController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning objectives-custom-panel">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $chief_user->chief->ChiefName }} Objectives</b>
                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">
									<button id="btn-add" 
                                            class="btn btn-primary btn-block btn-md" 
                                            ng-click="toggle('add', 0)">
                                            Add New Chief's Objective
                                    </button>
								</div>
								<div class="col-lg-5 pull-right">
									<form>
								        <div class="form-group">
								        	<div class="input-group">
									            <span class="input-group-addon">
							                    	<i class="fa fa-search fa-fw"></i>
							                    </span>
									            <input type="text" 
                                                        ng-model="search" 
                                                        class="form-control" 
                                                        placeholder="Search here..." />
								        	</div>
								        </div>
								    </form>
								</div>
							</div>
							<!--/.div class row-->
							<div class="row">
								<div ng-show="info" class="alert alert-info objective-info-name">
                                    <i class="fa fa-info-circle fa-fw"></i>Chief Objectives of {{ $chief_user->chief->ChiefName }}.
                                </div>
                                <div ng-show="info" class="alert alert-info objective-info-abb">
                                    <i class="fa fa-info-circle fa-fw"></i>Chief Objectives of {{ $chief_user->chief->ChiefAbbreviation }}.
                                </div>
							</div>
							<!--./div class row-->
                            <div class="table-responsive" ng-show="info">
    							<table class="table table-bordered">
    								<thead>
                                        <td class="chief_objective-name">
                                            Objective Name
                                        </td>

                                        <td class="chief_objective-perspective">
                                            Perspective
                                        </td>
                                        
    									<td></td>
    								</thead>
    								
                                    <tr dir-paginate='chief_objective in chief_objectives|
                                        orderBy: "updated_at":true:sortKey:reverse|
                                        filter:search|
                                        itemsPerPage:5'>

    									<td>
                                            <% chief_objective.ChiefObjectiveName %>
                                        </td>
    									<td>
                                            <% chief_objective.perspective.PerspectiveName %>
                                        </td>

    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" 
                                                    ng-click="toggle('edit', chief_objective.ChiefObjectiveID)">
                                                    <span class="fa fa-edit fa-fw"></span>
                                            </button>
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

		<!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" 
                                class="close" 
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>


                     <div class="modal-body">
                        <form name="frmEditObjective" class="form-horizontal" novalidate="">
                            <table class="table table-responsive">
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="objective_name" 
                                                class="control-label">Objective Name:
                                        </label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' 
                                                id="id_objective_name" 
                                                name="objective_name" 
                                                value="<% chief_objective.ChiefObjectiveName %>" 
                                                ng-model="chief_objective.ChiefObjectiveName" 
                                                autocomplete="off" 
                                                class="form-control" 
                                                required ng-touched />
                                        <span class="help-inline" 
                                                ng-show="userForm.objective_name.$invalid && !userForm.objective_name.$pristine">
                                            Objective Name is required.
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="perspective_id" class="control-label">
                                            Perspective:
                                        </label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_perspective_id" 
                                                name="perspective_id"
                                                data-ng-model="selectedUserProfile" 
                                                class="form-control" 
                                                data-ng-options="userprofile.PerspectiveName for userprofile in perspective" 
                                                required ng-touched >    
                                        </select>
                                        <span ng-show="userForm.perspective_id.$invalid && !userForm.perspective_id.$pristine" class="help-inline">
                                            Perspective is required.
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="inputEmail3" class="control-label">Chief:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <p>{{ $chief_user->chief->ChiefName }}</p>
                                        <input type="hidden" 
                                                name="StaffID" 
                                                value="<?=$chief_user->chief->ChiefID?>" 
                                                id="chief_id" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="inputEmail3" class="control-label">Account User:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <p>
                                            {{ $chief_user->rank->RankCode }} 
                                            {{ $chief_user->UserChiefFirstName }} 
                                            {{ $chief_user->UserChiefLastName }} 
                                        </p>
                                        <input type="hidden" 
                                                name="UserChiefID" 
                                                value="<?=$chief_user->UserChiefID?>" 
                                                id="user_chief_id">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" 
                                class="btn btn-success btn-sm btn-block" 
                                id="btn-save" 
                                ng-click="save(modalstate, id)" 
                                ng-disabled="frmEditObjective.$invalid">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>
  
@endsection