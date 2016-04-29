@extends('layout-chief')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/chief_measures.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APIChiefMeasureController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-8">
					<div class="panel panel-warning">
						<div class="panel-heading measures-custom-heading">
						  <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $chief->ChiefAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Chief's Measure</button>
								</div>
								<div class="col-lg-8">
									<form>
								        <div class="form-group">
								        	<div class="input-group">
									            <span class="input-group-addon">
							                    	<i class="fa fa-search fa-fw"></i>
							                    </span>
									            <input type="text" ng-model="search" class="form-control" placeholder="Search here..." />
								        	</div>
								        </div>
								    </form>
								</div>
							</div>
							<!--/.div class row-->
							<div class="row">
                                <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Chiefs Measures of {{ $chief_user->chief->ChiefName }}.</div>
                            </div>
							<!--./div class row-->

                            <div class="table-responsive" ng-show="info">
    							<table class="table table-striped table-bordered">
    								<thead>
    									<td class="objective-custom-td1">
                                            <b>Chief Measure Name</b>
    									</td>
    							
    									<td class="objective-custom-td2">
                                            <b>Chief Measure Type</b>
    									</td>


                                        <td class="objective-custom-td2">
                                            <b>Chief Measure Formula</b>
                                        </td>

    									</td>
    									<td class="objective-custom-td3">
                                            <b>Chief Office</b>
    									</td>
    									<td class="objective-custom-td4">
                                            <b>Last Encoded by</b>
    									</td>
    									<td class="objective-custom-td5"></td>
    								</thead>
    								<tr dir-paginate='chief_measure in chief_measures|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% chief_measure.ChiefMeasureName %></td>
    									<td><% chief_measure.ChiefMeasureType %></td>
                                        <td><% chief_measure.ChiefMeasureFormula %></td>
    									<td><% chief_measure.chief.ChiefAbbreviation %></td>
    									<td><% chief_measure.user_chief.rank.RankCode %> <% chief_measure.user_chief.UserChiefFirstName %> <% chief_measure.user_chief.UserChiefLastName %></td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', chief_measure.ChiefMeasureID)"><span class="fa fa-edit fa-fw"></button>
    										<!--<button class="btn btn-danger btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button>-->
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
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                   	
                    <div class="modal-body">
                        <form name="frmEditMeasure" class="form-horizontal" novalidate="">
                            <table class="table table-responsive">
                                <tr>
                                    <td>
                                        <label for="measure_name" class="control-label">Measure Name:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_measure_name" name="measure_name" value="<% chief_measure.ChiefMeasureName %>" ng-model="chief_measure.ChiefMeasureName" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.measure_name.$invalid && !userForm.measure_name.$pristine">Measure Name is required.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="measure_name" class="control-label">Measure Type:</label>
                                    </td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" id="id_measure_type" name="measure_type" value="LG" ng-model="chief_measure.ChiefMeasureType" />
                                                LG
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="measure_type" value="LD" ng-model="chief_measure.ChiefMeasureType" />
                                                LD
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <label for="measure_formula" class="control-label">Measure Formula:</label>
                                    </td>
                                    <td>
                                        <select id="id_measure_formula" name="measure_formula" data-ng-model="chief_measure.ChiefMeasureFormula" class="form-control" required ng-touched>
                                                    
                                                    <option value="Summation">
                                                        Summation
                                                    </option>
                                                    <option value="Average">
                                                        Average
                                                    </option>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label for="Chief">Chief Office:</label>
                                    </td>
                                    <td>
                                        <p>{{ $chief_user->chief->ChiefName }}</p>
                                        <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" id="chief_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="LastEncodedBy">Account User:</label>
                                    </td>
                                    <td>
                                        <p>{{ $chief_user->rank->RankCode }} {{ $chief_user->UserChiefFirstName }} {{ $chief_user->UserChiefLastName }} </p>
                                        <input type="hidden" name="UserChiefID" value="<?=$chief_user->UserChiefID?>" id="user_chief_id">
                                    </td>
                                </tr>
                            </table>
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