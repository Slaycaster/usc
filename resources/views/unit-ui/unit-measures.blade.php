@extends('layout-unit')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_measures.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APIUnitMeasureController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning measures-custom-panel">
						<div class="panel-heading measures-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->unit->UnitAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-2">
									<button id="btn-add" class="btn btn-primary btn-block btn-md" ng-click="toggle('add', 0)">Add New Measure</button>
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
							<div class="row" id="tableinfo">
                                <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>Unit Measures of {{ $user->unit->UnitName }}.</div>
                                 <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>Unit Measures of {{ $user->unit->UnitAbbreviation }}.</div>
                            </div>
                       
                                   
                                 

							<!--./div class row-->

                            <div class="table-responsive" ng-show="info" id="tabledata">
    							<table class="table table-bordered">
    								<thead>
                                        <tr>
        									<td class="unit_measure-name">
                                                Measure Name
        									</td>
        							
        									<td class="unit_measure-type">
                                                Type
        									</td>

                                             <td class="unit_measure-formula">
                                                Formula
                                            </td>

                                            <td class="unit_measure-objective">
                                                Objective
                                            </td>

                                            <td class="unit_measure-contributory">
                                                Contributory to Staff Measure
                                            </td>
        									<td class="unit_measure-encoder">
                                                Last Encoded by
        									</td>
        									<td class="unit_measure-edit"></td>
                                        </tr>
    								</thead>
    								<tr dir-paginate='unit_measure in unit_measures|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% unit_measure.UnitMeasureName %></td>
    									<td><% unit_measure.UnitMeasureType %></td>
                                        <td><% unit_measure.UnitMeasureFormula %></td>
                                        <td><% unit_measure.unit_objective.UnitObjectiveName %></td>
                                        <td><% unit_measure.staff_measure.StaffMeasureName %></td>
    									<td>
                                            <div class="col-md-5">
                                                <center>
                                                    <img ng-src="../uploads/userpictures/unit/cropped/<%unit_measure.user_unit.UserUnitPicturePath%>" height="30px;" class="thumbnail">
                                                </center>
                                            </div>
                                            
                                            <div style="font-size:12px;">

                                                <% unit_measure.user_unit.rank.RankCode %> 
                                                <% unit_measure.user_unit.UserUnitFirstName %> 
                                                <% unit_measure.user_unit.UserUnitLastName %>
                                            </div>
                                        </td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', unit_measure.UnitMeasureID)"><span class="fa fa-edit fa-fw"></button>
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
                                    <div class="alert alert-danger" ng-if="istrue =='true' "><span class="fa fa-warning fa-fw"></span> A Unit Measure was already assigned to the selected Staff Measure as contributory. Please pick another Staff Measure (if possible) or edit the said Unit Measure.</div>

                                    <td class="col-md-4 mod">
                                        <label for="measure_name" class="control">Measure Name:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_measure_name" name="measure_name" value="<% unit_measure.UnitMeasureName %>" ng-model="unit_measure.UnitMeasureName" autocomplete="off" class="form-control" required ng-touched />
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
                                                <input type="radio" id="id_measure_type" name="measure_type" value="LD" ng-model="unit_measure.UnitMeasureType" />
                                                LD
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="measure_type" value="LG" ng-model="unit_measure.UnitMeasureType" />
                                                LG
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="staff_measure" class="control">Contributory to Staff Measure:</label>
                                    </td>
                                    <div ng-if="hascontribute =='true'" class="alert alert-danger">
                            <i class="fa fa-warning  fa-fw">&nbsp;&nbsp;</i>  A Unit Measure was already assigned to the selected Staff Measure as contributory. Please pick another Staff Measure (if possible) or edit the said Unit Measure.<br />
                            </div>
                                    <td class="col-md-8">
                                        

                                         <select id="id_staff_measure" name="staff_measure" data-ng-model="selectedStaffMeasure" class="form-control" data-ng-options="mes.StaffMeasureName for mes in staffmeasure" required ng-touched ng-change="getStaffMeasureID()">

                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="measure_formula" class="control">Measure Formula:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_measure_formula" name="measure_formula" data-ng-model="selectedMeasureFormula" class="form-control" data-ng-options="mes.StaffMeasureFormula for mes in measureformula" required ng-touched>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="unit_objective" class="control">Unit Objective:</label>
                                    </td>
                                    <td class="col-md-8">
                                        

                                         <select id="id_unit_objective" name="unit_objective" data-ng-model="selectedUnitObjective" class="form-control" data-ng-options="unitobj.UnitObjectiveName for unitobj in unitobjective" required ng-touched>


                                    </td>
                                </tr>






                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="Unit">Unit:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->unit->UnitName }}</p>
                                        <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="LastEncodedBy">Account User:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->rank->RankCode }} {{ $user->UserUnitFirstName }} {{ $user->UserUnitLastName }} </p>
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id">
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