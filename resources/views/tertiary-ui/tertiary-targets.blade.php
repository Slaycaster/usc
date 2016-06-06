@extends('layout-tertiary-unit')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/tertiary_targets.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitTargetController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning targets-custom-panel">
						<div class="panel-heading measures-custom-heading">
						  <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $tertiaryunit->unitAbbreviation }} Targets for {{ date("Y") }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4">
									
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
                                <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Scorecard Target of {{ $user->tertiary_unit->TertiaryUnitName }}.</div>
                            </div>
							<!--./div class row-->

                            <div class="table-responsive" id="tabledata">
    							<table class="table table-bordered">
    								<thead>
    									<td class="chief_target-objective">
                                            Objective
    									</td>
    							
    									<td class="chief_target-measure">
                                            Measure
    									</td>


                                        <td class="chief_target-formula">
                                            Formula
                                        </td>

                                        <td class="chief_target-target">
                                            Target Period
                                        </td>

    									<td class="chief_target-action">
                                            Action
    									</td>
    									<td class="chief_target-date">
                                            Effectivity Date
    									</td>
    									
    								</thead>
    								<tr dir-paginate='tertiary_unit_target in tertiary_unit_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% tertiary_unit_target.tertiary_measure.tertiary_objective.TertiaryObjectiveName %></td>
    									<td><% tertiary_unit_target.tertiary_measure.TertiaryMeasureName %></td>
                                        <td><% tertiary_unit_target.tertiary_measure.TertiaryMeasureFormula %></td>
                                        <td><% tertiary_unit_target.TargetPeriod %></td>
    									<td>
    										<button id="btn-add" class="btn btn-info btn-block btn-md" ng-click="toggle('view', tertiary_unit_target.TertiaryUnitTargetID, tertiary_unit_target.tertiary_measure.tertiaryMeasureName )">View Target</button>
    										<br>
    										<button id="btn-add" class="btn btn-warning btn-block btn-md" ng-click="toggle('show', tertiary_unit_target.tertiaryTargetID, tertiary_unit_target.tertiary_measure.tertiaryMeasureName)">Set Target</button>

    									</td>
                                        <input type="hidden" ng-model="targetdate" ng-init="target_date=tertiary_unit_target.TargetDate" />
    									<td  ng-if="target_date!='0000-00-00'"><% tertiary_unit_target.TargetDate | date:"MMM d, y" %></td>
                                        <td  ng-if="target_date=='0000-00-00'">Not set</td>
    									
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
        <div class="modal fade" id="targetModal" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% this_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmShowTarget" class="form-horizontal" novalidate="">
                            <table class="table table-responsive">
                                <tr>
                                    <td><h4><b><% tertiary_unit_measurename %></b></h4></td>
                                </tr>
                            </table>
                                <tr>
                                    <td>
                                        <label for="target_name" class="control-label">Set Target Period:</label>
                                    </td>
                                    <td>
                                        <select id="id_target_period" name="measure_formula" data-ng-model="tertiary_unit_target.TargetPeriod" class="form-control"  required ng-touched> 
                                                   
                                                    <option value="Monthly">
                                                        Monthly
                                                    </option>
                                                    <option value="Quarterly">
                                                        Quarterly
                                                    </option>
                                        </select>
                                    </td>

                                </tr>        

                                
                                    <div class="table-responsive" id="monthlyform" style='display:none;'>
                                        <table class="table">
                                    <!-- Modal (Pop up when detail button clicked) FOR MONTHLY -->
                                            <tr>
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">January:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_january_target" valid-number name="monthlyform" value="<% tertiary_unit_target.JanuaryTarget %>" ng-model="tertiary_unit_target.JanuaryTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for January is required.</span>
                                                </td>
                                              
                                        
                                        
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">April:</label>
                                                </td>   
                                                <td class="col-md-2">
                                                    <input type='text' id="id_april_target" valid-number name="monthlyform" value="<% tertiary_unit_target.AprilTarget %>" ng-model="tertiary_unit_target.AprilTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for April is required.</span>
                                                </td> 

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">July:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_july_target" valid-number name="monthlyform" value="<% tertiary_unit_target.JulyTarget %>" ng-model="tertiary_unit_target.JulyTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for July is required.</span>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">October:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_october_target" valid-number name="monthlyform" value="<% tertiary_unit_target.OctoberTarget %>" ng-model="tertiary_unit_target.OctoberTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for October is required.</span>
                                                </td>                                  
                                            </tr>


                                            <tr>
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">February:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_february_target" valid-number name="monthlyform" value="<% tertiary_unit_target.FebruaryTarget %>" ng-model="tertiary_unit_target.FebruaryTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for February is required.</span>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">May:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_may_target" valid-number name="monthlyform" value="<% tertiary_unit_target.MayTarget %>" ng-model="tertiary_unit_target.MayTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for May is required.</span>
                                                </td>
                                    
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">August:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_august_target" valid-number name="monthlyform" value="<% tertiary_unit_target.AugustTarget %>" ng-model="tertiary_unit_target.AugustTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for August is required.</span>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">November:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_november_target" valid-number name="monthlyform" value="<% tertiary_unit_target.NovemberTarget %>" ng-model="tertiary_unit_target.NovemberTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for November is required.</span>
                                                </td>
                                   
                                            </tr>

                                            <tr>
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">March:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_march_target" valid-number name="monthlyform" value="<% tertiary_unit_target.MarchTarget %>" ng-model="tertiary_unit_target.MarchTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for March is required.</span>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">June:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_june_target" valid-number name="monthlyform" value="<% tertiary_unit_target.JuneTarget %>" ng-model="tertiary_unit_target.JuneTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for June is required.</span>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">September:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_september_target" valid-number name="monthlyform" value="<% tertiary_unit_target.SeptemberTarget %>" ng-model="tertiary_unit_target.SeptemberTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for September is required.</span>
                                                </td>
                                   
                                                <td class="col-md-1">
                                                    <label for="monthlyform" class="control-label">December:</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <input type='text' id="id_december_target" valid-number name="monthlyform" value="<% tertiary_unit_target.DecemberTarget %>" ng-model="tertiary_unit_target.DecemberTarget" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for December is required.</span>
                                                </td>
                                            </tr>
                                        </table>
                                            
                                                <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Make sure you're entering necessary values, once saved you can't update it till next year.</div>
                                                 
                                            <!-- <label for="monthlyform" class="control-label">Enter your credentials to continue:</label><br>

                                                 <input type='text' id="id_badge_text" valid-number name="monthlyform" value="" ng-model="" placeholder="Badge text" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Badge text is required.</span><br>
                                                 <input type='text' id="id_password" valid-number name="monthlyform" value="" ng-model="" placeholder="Password" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Password is required.</span> -->
                                          
                                         

                                           <input type="hidden" id="target_date" name="date" value="<% date | date : 'yyyy-MM-dd' %>">
                                           
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)">Submit</button>

                                            </div>


                                    </div>



                            <!-- Modal (Pop up when detail button clicked) FOR QUARTERTLY -->
                                    <div id="quarterlyform" style='display:none;'>
                                     <table class="table table-responsive">
                                    <td>
                                        <label for="quarterlyform" class="control-label">First Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_firstquarter_target" name="quarterlyform" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for First Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Second Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_secondquarter_target" name="quarterlyform" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Second Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Third Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_thirdquarter_target" name="quarterlyform" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Third Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Fourth Quarter:</label>
                                    </td>
                                    <td>

                                        <input type='text' id="id_fourthquarter_target" name="quarterlyform" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Fourth Quarter is required.</span>
                                    </td>
                                    </table>
                                     <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Make sure you're entering necessary values, once saved you can't update it till next year.</div>
                                                 
                                            <!-- <label for="monthlyform" class="control-label">Enter your credentials to continue:</label><br>

                                                 <input type='text' id="id_badge_text" valid-number name="monthlyform" value="" ng-model="" placeholder="Badge text" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Badge text is required.</span><br>
                                                 <input type='text' id="id_password" valid-number name="monthlyform" value="" ng-model="" placeholder="Password" autocomplete="off" class="form-control" required ng-touched />
                                                    <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Password is required.</span> -->
                                           

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditTarget.$invalid">Submit</button>
                                            </div>
                                    </div>
                                 
                        </form>

                    </div>
                </div>
            </div>
        </div>

                <div class="modal fade" id="alreadysetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                        <label for="measure_name" class="control-label">The Monthly Targets for the Measure: <% unit_measurename %></label><br><br>
                            <table class="table table-responsive">
                                
                                 <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Targets have been already set. You just have to do this once.</div>

                                 
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
         

        <div class="modal fade" id="monthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                        <label for="measure_name" class="control-label">The Monthly Targets for the Measure: <% unit_measurename %></label><br><br>
                            <table class="table table-responsive">
                                
                                <tr ir-paginate='tertiary_unit_target in tertiary_unit_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <tr>
                                    <td><b>January:</b> <% tertiary_unit_target.JanuaryTarget %></td>
                                    <td><b>April:</b> <% tertiary_unit_target.AprilTarget %></td>
                                    <td><b>July:</b> <% tertiary_unit_target.JulyTarget %></td>
                                    <td><b>October:</b> <% tertiary_unit_target.OctoberTarget %></td>
                                    </tr>
                                    <tr>
                                    <td><b>February:</b> <% tertiary_unit_target.FebruaryTarget %></td>
                                    <td><b>May:</b> <% tertiary_unit_target.MayTarget %></td>
                                    <td><b>August:</b> <% tertiary_unit_target.AugustTarget %></td>
                                    <td><b>November:</b> <% tertiary_unit_target.NovemberTarget %></td>
                                    </tr>
                                    <tr>
                                    <td><b>March:</b> <% tertiary_unit_target.MarchTarget %></td>
                                    <td><b>June:</b> <% tertiary_unit_target.JuneTarget %></td>
                                    <td><b>September:</b> <% tertiary_unit_target.SeptemberTarget %></td>
                                    <td><b>December:</b> <% tertiary_unit_target.DecemberTarget %></td>
                                    </tr>
                                    
                                </tr>

                                 
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>

       
        <div class="modal fade" id="quarterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                        <label for="measure_name" class="control-label">The Quarterly Targets for the Measure: <% unit_measurename %> </label><br><br>
                            <table class="table table-responsive">
                                
                                <tr ir-paginate='tertiary_unit_target in tertiary_unit_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    
                                    <tr><b>Quarter 1:</b> &nbsp;&nbsp;&nbsp;<% firstquarter %></tr><br><br>
                                    <tr><b>Quarter 2:</b> &nbsp;&nbsp;&nbsp;<% secondquarter %></tr><br><br>
                                    <tr><b>Quarter 3:</b> &nbsp;&nbsp;&nbsp;<% thirdquarter %></tr><br><br>
                                    <tr><b>Quarter 4:</b> &nbsp;&nbsp;&nbsp;<% fourthquarter %></tr><br>
                                    
                                    
                                </tr>

                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="notsetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                <i>Oops! It seems that the <b>targets for this measure are not set</b> yet. <br>Go to Set Targets to do so.</i>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        

    </div>

<script type="text/javascript">
$(document).ready(function(){
    $('#id_target_period').on('change', function() {
      if ( this.value == 'Monthly')
      {
        $("#monthlyform").show();
        $("#quarterlyform").hide();
      }
      else if ( this.value == 'Quarterly')
      {
        $("#quarterlyform").show();
        $("#monthlyform").hide();
      }
    });
});
</script>
@endsection