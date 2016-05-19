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
				<div class="col-lg-12">
					<div class="panel panel-warning measures-custom-panel">
						<div class="panel-heading measures-custom-heading">
						  <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $chief->ChiefAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Chief's Measure</button>
								</div>
								<div class="col-lg-6 pull-right">
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
                                <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>Chief Measures of {{ $chief_user->chief->ChiefName }}.</div>
                                <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>Chief Measures of {{ $chief_user->chief->ChiefAbbreviation }}.</div>
                            </div>
							<!--./div class row-->

                            <div class="table-responsive" ng-show="info">
    							<table class="table table-bordered">
    								<thead>
    									<td class="chief_measure-name">
                                            Measure Name
    									</td>
    							
    									<td class="chief_measure-type">
                                            Type
    									</td>
                                        <td class="chief_measure-formula">
                                            Formula
                                        </td>

                                        <td class="chief_measure-objective">
                                            Objective
                                        </td>
    	
    									<td class="staff_measure-edit"></td>
    								</thead>
    								<tr dir-paginate='chief_measure in chief_measures|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% chief_measure.ChiefMeasureName %></td>
    									<td><% chief_measure.ChiefMeasureType %></td>
                                        <td><% chief_measure.ChiefMeasureFormula %></td>
                                        <td><% chief_measure.chief_objective.ChiefObjectiveName %></td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', chief_measure.ChiefMeasureID)"><span class="fa fa-edit fa-fw"></button>
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
                                    <td class="col-md-4 mod">
                                        <label for="measure_name" class="control">Measure Name:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_measure_name" name="measure_name" value="<% chief_measure.ChiefMeasureName %>" ng-model="chief_measure.ChiefMeasureName" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.measure_name.$invalid && !userForm.measure_name.$pristine">Measure Name is required.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="measure_name" class="control">Measure Type:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" id="id_measure_type" name="measure_type" value="LD" ng-model="chief_measure.ChiefMeasureType" />
                                                LD
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="measure_type" value="LG" ng-model="chief_measure.ChiefMeasureType" />
                                                LG
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="measure_formula" class="control">Measure Formula:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_measure_formula" name="measure_formula" data-ng-model="chief_measure.ChiefMeasureFormula" class="form-control" required ng-touched>
                                                     <option value="">
                                                        Select Formula
                                                    </option>
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
                                    <td class="col-md-4 mod">
                                        <label for="chief_objective" class="control">Chief Objective:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_chief_objective" name="chief_objective" data-ng-model="chief_measure.ChiefObjectiveID" class="form-control" required ng-touched>
                                           
                                            @foreach($chief_objectives as $chief_objective)
                                                    <option value="<?=$chief_objective->ChiefObjectiveID?>">
                                                        {{ $chief_objective->ChiefObjectiveName }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="Chief">Chief Office:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <p>{{ $chief_user->chief->ChiefName }}</p>
                                        <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" id="chief_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="LastEncodedBy">Account User:</label>
                                    </td>
                                    <td class="col-md-8">
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