@extends('layout-unit')

@section('content')

  <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_measures.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
    <br>
    <div ng-app="unitMeasureApp" ng-controller="APIUnitMeasureController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-8">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->unit->UnitAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Unit's Measure</button>
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
								<div class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> To sort, click on the table's column in order to sort ascending/descending.</div>
							</div>
							<!--./div class row-->

							<table class="table table-striped table-responsive table-bordered">
								<thead>
									<td ng-click="sort('unit_measure.UnitMeasureName')"><b>Unit Measure Name</b>
										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_measure.UnitmeasureName'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
									</td>
							
									<td ng-click="sort('unit_measure.UnitMeasureType')"><b>Unit Measure Type</b>
										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_measure.UnitMeasureType'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
									</td>

									</td>
									<td ng-click="sort('unit_measure.unit.UnitAbbreviation')"><b>Unit</b>
										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_measure.unit.UnitAbbreviation'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
									</td>
									<td ng-click="sort('unit_measure.user_unit.rank.RankCode')"><b>Last Encoded by</b>
										<span class="glyphicon sort-icon" ng-show="sortKey=='unit_measure.user_unit.rank.RankCode'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
									</td>
									<td></td>
								</thead>
								<tr dir-paginate='unit_measure in unit_measures|orderBy:sortKey:reverse|filter:search|itemsPerPage:5'>
									<td><% unit_measure.UnitMeasureName %></td>
									<td><% unit_measure.UnitMeasureType %></td>
									<td><% unit_measure.unit.UnitAbbreviation %></td>
									<td><% unit_measure.user_unit.rank.RankCode %> <% unit_measure.user_unit.UserUnitFirstName %> <% unit_measure.user_unit.UserUnitLastName %></td>
									<td>
										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', unit_measure.UnitMeasureID)"><span class="fa fa-edit fa-fw"></button>
										<!--<button class="btn btn-danger btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button>-->
									</td>
								</tr>
							</table>
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
                        <form name="frmEditMeasure" class="form-horizontal" novalidate="">

                            <div class="form-group error">
                                <label for="measure_name" class="col-sm-3 control-label">Measure Name:</label>
                                <div class="col-sm-9">
                                    <input type='text' name="measure_name" value="<% unit_measure.UnitMeasureName %>" ng-model="unit_measure.UnitMeasureName" autocomplete="off" class="form-control" required ng-touched>
									<span class="help-inline" ng-show="userForm.measure_name.$invalid && !userForm.measure_name.$pristine">Measure Name is required.</span>
                                </div>
                            </div>

                            <div class="form-group error">
					            <label for="measure_name" class="col-sm-3 control-label">Measure Type:</label>
								    <div class="col-sm-3 form-group">
								        <div class="radio">
								            <label>
								                <input type="radio" name="measure_type" value="LG" ng-model="unit_measure.UnitMeasureType">
								                LG
								            </label>
								        </div>
								        <div class="radio">
								            <label>
								                <input type="radio" name="measure_type" value="LD" ng-model="unit_measure.UnitMeasureType">
								                LD
								            </label>
								        </div>
								    </div>

					            <span class="help-inline" ng-show="userForm.measure_type.$invalid && !userForm.measure_type.$pristine">Measure Type is required.</span>
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
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditMeasure.$invalid">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
  

@endsection