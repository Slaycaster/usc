@extends('layout-unit')

@section('content')

	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
    <br>
	<div ng-app="unitObjectiveApp" ng-controller="unitObjectiveController">
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
    							<table class="table table-striped  table-bordered">
    								<thead>
    									<td ng-click="sort('unit_objective.UnitObjectiveName')"><b>Unit Objective Name</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.UnitObjectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td ng-click="sort('unit_objective.perspective.PerspectiveName')"><b>Perspective</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.perspective.PerspectiveName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td ng-click="sort('unit_objective.unit.UnitAbbreviation')"><b>Unit</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.unit.UnitAbbreviation'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td ng-click="sort('unit_objective.user_unit.rank.RankCode')"><b>Last Encoded by</b>
    										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_objective.user_unit.rank.RankCode'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
    									</td>
    									<td></td>
    								</thead>
    								<tr dir-paginate='unit_objective in unit_objectives|orderBy:sortKey:reverse|filter:search|itemsPerPage:5'>
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

                            <div class="form-group error">
                                <label for="objective_name" class="col-sm-3 control-label">Objective Name</label>
                                <div class="col-sm-9">
                                    <input type='text' name="objective_name" value="<% unit_objective.UnitObjectiveName %>" ng-model="unit_objective.UnitObjectiveName" autocomplete="off" class="form-control" required ng-touched>
									<span class="help-inline" ng-show="userForm.objective_name.$invalid && !userForm.objective_name.$pristine">Objective Name is required.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="perspective_id" class="col-sm-3 control-label">Perspective</label>
                                <div class="col-sm-9">
                                    <select name="perspective_id" data-ng-model="unit_objective.PerspectiveID" class="form-control" required ng-touched>
										@foreach($perspectives as $perspective)
												<option value="<?=$perspective->PerspectiveID?>">{{ $perspective->PerspectiveName }}</option>
										@endforeach
									</select>
									<span ng-show="userForm.perspective_id.$invalid && !userForm.perspective_id.$pristine" class="help-inline">Perspective is required.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Unit:</label>
                                <div class="col-sm-9">
                                    <p>{{ $user->unit->UnitName }}</p>
                                    <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Last Encoded by:</label>
                                <div class="col-sm-9">
                                    <p>{{ $user->rank->RankCode }} {{ $user->UserUnitFirstName }} {{ $user->UserUnitLastName }} </p>
                                    <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id">
                            </div>

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