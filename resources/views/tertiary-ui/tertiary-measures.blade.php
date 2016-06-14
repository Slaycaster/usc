@extends('layout-tertiary-unit')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/tertiary_unit_measures.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitMeasureController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning measures-custom-panel">
						<div class="panel-heading measures-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->tertiary_unit->TertiaryUnitAbbreviation }} Measures</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
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
                                <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>Tertiary Unit Measures of {{ $user->tertiary_unit->TertiaryUnitName }}.</div>
                                 <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>Tertiary Unit Measures of {{ $user->tertiary_unit->TertiaryUnitAbbreviation }}.</div>
                            </div>
                       
                                   
                                 

							<!--./div class row-->

                            <div class="table-responsive" ng-show="info" id="tabledata">
    							<table class="table table-bordered">
    								<thead>
                                        <tr>
        									<td class="tertiary_measure-name">
                                                Measure Name
        									</td>
        							
        									<td class="tertiary_measure-type">
                                                Type
        									</td>

                                             <td class="tertiary_measure-formula">
                                                Formula
                                            </td>

                                            <td class="tertiary_measure-objective">
                                                Objective
                                            </td>

                                            <td class="tertiary_measure-contributory">
                                                Contributory to {{ $tertiary_unit->secondary_unit->SecondaryUnitAbbreviation }}'s Measure
                                            </td>
        									<td class="tertiary_measure-encoder">
                                                Last Encoded by
        									</td>
        									<td class="tertiary_measure-edit"></td>
                                        </tr>
    								</thead>
    								<tr dir-paginate='tertiary_unit_measure in tertiary_unit_measures|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% tertiary_unit_measure.TertiaryUnitMeasureName %></td>
    									<td><% tertiary_unit_measure.TertiaryUnitMeasureType %></td>
                                        <td><% tertiary_unit_measure.TertiaryUnitMeasureFormula %></td>
                                        <td><% tertiary_unit_measure.tertiary_unit_objective.TertiaryUnitObjectiveName %></td>
                                        <td><% tertiary_unit_measure.secondary_unit_measure.SecondaryUnitMeasureName %></td>
    									<td>
                                            <div class="col-md-5">
                                                <center>
                                                    <img ng-src="../uploads/userpictures/tertiary/cropped/<%tertiary_unit_measure.user_tertiary_unit.UserTertiaryUnitPicturePath%>" height="30px;" class="thumbnail">
                                                </center>
                                            </div>
                                            
                                            <div style="font-size:12px;">

                                                <% tertiary_unit_measure.user_tertiary_unit.rank.RankCode %> 
                                                <% tertiary_unit_measure.user_tertiary_unit.UserTertiaryUnitFirstName %> 
                                                <% tertiary_unit_measure.user_tertiary_unit.UserTertiaryUnitLastName %>
                                            </div>
                                        </td>
    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit', tertiary_unit_measure.TertiaryUnitMeasureID)"><span class="fa fa-edit fa-fw"></button>
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
                                    <div class="alert alert-danger" ng-if="istrue =='true' "><span class="fa fa-warning fa-fw"></span> A Tertiary Unit Measure was already assigned to the selected Secondary Unit Measure as contributory. Please pick another Secondary Unit Measure (if possible) or edit the said  Tertiary Unit Measure.</div>

                                    <td class="col-md-4 mod">
                                        <label for="measure_name" class="control">Measure Name:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_measure_name" name="measure_name" value="<% tertiary_unit_measure.TertiaryUnitMeasureName %>" ng-model="tertiary_unit_measure.TertiaryUnitMeasureName" autocomplete="off" class="form-control" required ng-touched />
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
                                                <input type="radio" id="id_measure_type" name="measure_type" value="LD" ng-model="tertiary_unit_measure.TertiaryUnitMeasureType" />
                                                LD
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="measure_type" value="LG" ng-model="tertiary_unit_measure.TertiaryUnitMeasureType" />
                                                LG
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <div ng-if="hascontribute =='true'" class="alert alert-danger">
                            <i class="fa fa-warning  fa-fw">&nbsp;&nbsp;</i>  A Tertiary Unit Measure was already assigned to the selected Secondary Unit Measure as contributory. Please pick another Secondary Unit Measure (if possible) or edit the said Tertiary Unit Measure.<br />
                            </div>
                                    <td class="col-md-4 mod">
                                        <label for="secondary_unit_measure" class="control">Contributory to {{ $tertiary_unit->secondary_unit->SecondaryUnitAbbreviation }}'s Measure:</label>
                                    </td>
                                    <td class="col-md-8">
                                        

                                         <select id="id_secondary_unit_measure" name="secondary_unit_measure" data-ng-model="selectedSecondaryUnitMeasure" class="form-control" data-ng-options="mes.SecondaryUnitMeasureName for mes in secondary_unit_measure" required ng-touched ng-change="getSecondaryUnitMeasureID()">

                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="measure_formula" class="control">Measure Formula:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_measure_formula" name="measure_formula" data-ng-model="selectedMeasureFormula" class="form-control" data-ng-options="mes.SecondaryUnitMeasureFormula for mes in measureformula" required ng-touched>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="unit_objective" class="control">Tertiary Unit Objective:</label>
                                    </td>
                                    <td class="col-md-8">
                                        

                                         <select id="id_unit_objective" name="unit_objective" data-ng-model="selectedTertiaryUnitObjective" class="form-control" data-ng-options="tertiary_unit_obj.TertiaryUnitObjectiveName for tertiary_unit_obj in tertiary_unit_objective" required ng-touched>


                                    </td>
                                </tr>






                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="Unit">Tertiary Unit:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->tertiary_unit->TertiaryUnitName }}</p>
                                        <input type="hidden" name="TertiaryUnitID" value="<?=$user->tertiary_unit->TertiaryUnitID?>" id="tertiary_unit_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="LastEncodedBy">Account User:</label>
                                    </td>
                                    <td class="col-md-8 mod">
                                        <p>{{ $user->rank->RankCode }} {{ $user->UserTertiaryUnitFirstName }} {{ $user->UserTertiaryUnitLastName }} </p>
                                        <input type="hidden" name="UserTertiaryUnitID" value="<?=$user->UserTertiaryUnitID?>" id="user_tertiary_id">
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