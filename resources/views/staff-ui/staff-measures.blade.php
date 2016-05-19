@extends('layout-staff')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_measures.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APIStaffMeasureController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning measures-custom-panel">
						<div class="panel-heading measures-custom-heading">
						  <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $staff->StaffAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Staff's Measure</button>
								</div>
								<div class="col-lg-5 pull-right">
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
                                <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Staff's Measures of {{ $staff_user->staff->StaffName }}.</div>
                            </div>
							<!--./div class row-->

                            <div class="table-responsive" ng-show="info">
    							<table class="table table-bordered">
    								<thead>
    									<td class="staff-custom-td1">
                                            Staff Measure Name
    									</td>
    							
    									<td class="staff-custom-td2">
                                            Staff Measure Type
    									</td>
                                        <td class="staff-custom-td3">
                                            Staff Measure Formula
                                        </td>

                                        <td class="staff-custom-td4">
                                            Staff Objective
                                        </td>

                                        <td class="staff-custom-td5">
                                            Contributory to Chief's Measure
                                        </td>

    									</td>
    									<td class="staff-custom-td6">
                                            Staff Office
    									</td>
    									<td class="staff-custom-td7">
                                            Last Encoded by
    									</td>
    									<td class="staff-custom-td8"></td>
    								</thead>
    								<tr dir-paginate='staff_measure in staff_measures|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% staff_measure.StaffMeasureName %></td>
    									<td><% staff_measure.StaffMeasureType %></td>
                                        <td><% staff_measure.StaffMeasureFormula %></td>
                                        <td><% staff_measure.staff_objective.StaffObjectiveName %></td>
    									<td><% staff_measure.chief_measure.ChiefMeasureName %></td>
                                        <td><% staff_measure.staff.StaffAbbreviation %></td>
    									<td><% staff_measure.user_staff.rank.RankCode %> <% staff_measure.user_staff.UserStaffFirstName %> <% staff_measure.user_staff.UserStaffLastName %></td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', staff_measure.StaffMeasureID)"><span class="fa fa-edit fa-fw"></button>
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
            <div class="modal-dialog">
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
                                        <input type='text' id="id_measure_name" name="measure_name" value="<% staff_measure.StaffMeasureName %>" ng-model="staff_measure.StaffMeasureName" autocomplete="off" class="form-control" required ng-touched />
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
                                                <input type="radio" id="id_measure_type" name="measure_type" value="LD" ng-model="staff_measure.StaffMeasureType" />
                                                LD
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="measure_type" value="LG" ng-model="staff_measure.StaffMeasureType" />
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
                                        <select id="id_measure_formula" name="measure_formula" data-ng-model="staff_measure.StaffMeasureFormula" class="form-control" required ng-touched>
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
                                        <label for="staff_objective" class="control">Staff Objective:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_staff_objective" name="staff_objective" data-ng-model="staff_measure.StaffObjectiveID" class="form-control" required ng-touched>
                                           
                                            @foreach($staff_objectives as $staff_objective)
                                                    <option value="<?=$staff_objective->StaffObjectiveID?>" >
                                                        {{ $staff_objective->StaffObjectiveName }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="chief_measure" class="control">Contributory to Chief's Measure:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_chief_measure" name="chief_measure" data-ng-model="staff_measure.ChiefMeasureID" class="form-control" required ng-touched>
                                                     <option value="0">
                                                        Select Chief Measure
                                                    </option>
                                            @foreach($chief_measures as $chief_measure)
                                                    <option value="<?=$chief_measure->ChiefMeasureID?>">
                                                        {{ $chief_measure->ChiefMeasureName }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="Chief">Staff Office:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $staff_user->staff->StaffName }}</p>
                                        <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="LastEncodedBy">Account User:</label>
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
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditMeasure.$invalid">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection