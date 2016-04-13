@extends('layout-unit')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_objectives.js') }}"></script>

    <br>
	<div ng-app="unitScorecardApp" ng-controller="unitObjectiveController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-8">
					<div class="panel panel-warning">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->unit->UnitAbbreviation }} Objectives</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Unit's Objective</button>
								</div>
								<div class="col-lg-8">
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
    									<td class="objective-custom-td1" ng-click="sort('unit_objective.UnitObjectiveName')"><b>Unit Objective Name</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.UnitObjectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td2" ng-click="sort('unit_objective.perspective.PerspectiveName')"><b>Perspective</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.perspective.PerspectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td3" ng-click="sort('unit_objective.unit.UnitAbbreviation')"><b>Unit</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.unit.UnitAbbreviation'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td4" ng-click="sort('unit_objective.user_unit.rank.RankCode')"><b>Last Encoded by</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.user_unit.rank.RankCode'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td class="objective-custom-td5"></td>
    								</thead>
    								<tr dir-paginate='unit_objective in unit_objectives|orderBy: "updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% unit_objective.UnitObjectiveName %></td>
    									<td><% unit_objective.perspective.PerspectiveName %></td>
    									<td><% unit_objective.unit.UnitAbbreviation %></td>
    									<td><% unit_objective.user_unit.rank.RankCode %> <% unit_objective.user_unit.UserUnitFirstName %> <% unit_objective.user_unit.UserUnitLastName %></td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', unit_objective.UnitObjectiveID)"><span class="fa fa-edit fa-fw"></button>
    										<!--<button class="btn btn-danger btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button>-->
    									</td>
    								</tr>
    							</table>
							<!--./table table striped-->
                            </div>
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
                                    <td>
                                        <label for="objective_name" class="control-label">Objective Name:</label>
                                    </td>
                                    <td>
                                        <input type='text' name="objective_name" value="<% unit_objective.UnitObjectiveName %>" ng-model="unit_objective.UnitObjectiveName" autocomplete="off" class="form-control" required ng-touched>
                                        <span class="help-inline" ng-show="userForm.objective_name.$invalid && !userForm.objective_name.$pristine">Objective Name is required.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="perspective_id" class="control-label">Perspective:</label>
                                    </td>
                                    <td>
                                        <select name="perspective_id" data-ng-model="unit_objective.PerspectiveID" class="form-control" required ng-touched>
                                            @foreach($perspectives as $perspective)
                                                    <option value="<?=$perspective->PerspectiveID?>">{{ $perspective->PerspectiveName }}</option>
                                            @endforeach
                                        </select>
                                        <span ng-show="userForm.perspective_id.$invalid && !userForm.perspective_id.$pristine" class="help-inline">Perspective is required.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="inputEmail3" class="control-label">Unit:</label>
                                    </td>
                                    <td>
                                        <p>{{ $user->unit->UnitName }}</p>
                                        <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="inputEmail3" class="control-label">Account User:</label>
                                    </td>
                                    <td>
                                        <p>{{ $user->rank->RankCode }} {{ $user->UserUnitFirstName }} {{ $user->UserUnitLastName }} </p>
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id">
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