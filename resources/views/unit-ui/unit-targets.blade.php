@extends('layout-unit')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_targets.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIUnitTargetController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning targets-custom-panel">
						<div class="panel-heading measures-custom-heading">
						  <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $unit->unitAbbreviation }} Targets for {{ date("Y") }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
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
							<div class="row" id="tableinfo">
                                <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>Scorecard Target of {{ $user->unit->UnitName }}.</div>
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
    								<tr dir-paginate='unit_target in unit_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %></td>
    									<td><% unit_target.unit_measure.UnitMeasureName %></td>
                                        <td><% unit_target.unit_measure.UnitMeasureFormula %></td>
                                        <td><% unit_target.TargetPeriod %></td>
    									<td>
    										<input type="hidden" ng-model="targetperiod" ng-init="set_target=unit_target.TargetPeriod">

                                            <button ng-if="set_target!='Not Set'" id="btn-add" class="btn btn-info btn-block btn-md" ng-click="toggle('view', unit_target.UnitTargetID, unit_target.unit_measure.UnitMeasureName )">View Target</button>
                                            
                                            <button ng-if="set_target=='Not Set'" id="btn-add" class="btn btn-warning btn-block btn-md" ng-click="toggle('show', unit_target.UnitTargetID, unit_target.unit_measure.UnitMeasureName)">Set Target</button>


    									</td>
                                        <input type="hidden" ng-model="targetdate" ng-init="target_date=unit_target.TargetDate" />
    									<td  ng-if="target_date!='0000-00-00'"><% unit_target.TargetDate | date:"MMM d, y" %></td>
                                        <td  ng-if="target_date=='0000-00-00'">Not set</td>
    									
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



        <div class="modal fade" id="targetModal" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% this_title %></b></h4>
                    </div>
                    
                    <div class="modal-body">
                        <form name="frmShowTarget" class="form-horizontal" novalidate="">
                            
                            <h4 class="alert alert-success">
                                <b><% unit_measurename %></b>
                            </h4>

                            <div class="container-fluid">
                                <div class="col-md-3">
                                    <h4>Set Target Period:</h4>
                                </div>
                                <div class="col-md-4">
                                    <select id="id_target_period" name="measure_formula" data-ng-model="unit_target.TargetPeriod" class="form-control"  required ng-touched> 
                                               
                                            <option value="Monthly">
                                                Monthly
                                            </option>
                                            <option value="Quarterly">
                                                Quarterly
                                            </option>
                                    </select>
                                </div>
                            </div>


                            <br />
                            <!-- Modal (Pop up when detail button clicked) FOR MONTHLY -->  
                            <div  class="table-responsive" id="monthlyform" style='display:none;'>
                                <table class="table">
                                    <tr>
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">January:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_january_target" valid-number name="monthlyform" value="<% unit_target.JanuaryTarget %>" ng-model="unit_target.JanuaryTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for January is required.</span>
                                        </td>
                                      
                                
                                
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">April:</label>
                                        </td>   
                                        <td class="col-md-2">
                                            <input type='text' id="id_april_target" valid-number name="monthlyform" value="<% unit_target.AprilTarget %>" ng-model="unit_target.AprilTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for April is required.</span>
                                        </td> 

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">July:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_july_target" valid-number name="monthlyform" value="<% unit_target.JulyTarget %>" ng-model="unit_target.JulyTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for July is required.</span>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">October:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_october_target" valid-number name="monthlyform" value="<% unit_target.OctoberTarget %>" ng-model="unit_target.OctoberTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for October is required.</span>
                                        </td>                                  
                                    </tr>


                                    <tr>
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">February:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_february_target" valid-number name="monthlyform" value="<% unit_target.FebruaryTarget %>" ng-model="unit_target.FebruaryTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for February is required.</span>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">May:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_may_target" valid-number name="monthlyform" value="<% unit_target.MayTarget %>" ng-model="unit_target.MayTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for May is required.</span>
                                        </td>
                            
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">August:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_august_target" valid-number name="monthlyform" value="<% unit_target.AugustTarget %>" ng-model="unit_target.AugustTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for August is required.</span>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">November:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_november_target" valid-number name="monthlyform" value="<% unit_target.NovemberTarget %>" ng-model="unit_target.NovemberTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for November is required.</span>
                                        </td>
                           
                                    </tr>

                                    <tr>
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">March:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_march_target" valid-number name="monthlyform" value="<% unit_target.MarchTarget %>" ng-model="unit_target.MarchTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for March is required.</span>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">June:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_june_target" valid-number name="monthlyform" value="<% unit_target.JuneTarget %>" ng-model="unit_target.JuneTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for June is required.</span>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">September:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_september_target" valid-number name="monthlyform" value="<% unit_target.SeptemberTarget %>" ng-model="unit_target.SeptemberTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for September is required.</span>
                                        </td>
                           
                                        <td class="col-md-1">
                                            <label for="monthlyform" class="control-label">December:</label>
                                        </td>
                                        <td class="col-md-2">
                                            <input type='text' id="id_december_target" valid-number name="monthlyform" value="<% unit_target.DecemberTarget %>" ng-model="unit_target.DecemberTarget" autocomplete="off" class="form-control target-month" required ng-touched/>
                                            <span class="help-inline" ng-show="userForm.monthlyform.$invalid && !userForm.monthlyform.$pristine">Target for December is required.</span>
                                        </td>
                                    </tr>
                                    <tr style="background-color:transparent;">
                                        <td colspan="24">
                                            <br />
                                            <div ng-show="info" class="alert alert-warning container-fluid" ng-if="unit_target.JanuaryTarget != 0 && unit_target.FebruaryTarget != 0 && unit_target.MarchTarget != 0 && unit_target.AprilTarget != 0 && unit_target.MayTarget != 0 && unit_target.JuneTarget != 0 && unit_target.JulyTarget != 0 && unit_target.AugustTarget != 0 && unit_target.SeptemberTarget != 0 && unit_target.OctoberTarget != 0 && unit_target.NovemberTarget != 0 && unit_target.DecemberTarget != 0"><i class="fa fa-warning  fa-fw"></i> Please make sure that your input is correct. Once you "Add Target", you can no longer update it until next year.</div>
                                        </td>
                                        <td>
                                            <input type="hidden" id="target_date" name="date" value="<% date | date : 'yyyy-MM-dd' %>" />
                                        </td>
                                    </tr>
                                </table>   

                                <div class="col-md-3 pull-right" style="margin-bottom:1em; margin-top:-1em;">
                                    <button class="btn btn-success btn-sm btn-block pull-right"
                                     data-toggle="modal" ng-if="unit_target.JanuaryTarget != 0 && unit_target.FebruaryTarget != 0 && unit_target.MarchTarget != 0 && unit_target.AprilTarget != 0 && unit_target.MayTarget != 0 && unit_target.JuneTarget != 0 && unit_target.JulyTarget != 0 && unit_target.AugustTarget != 0 && unit_target.SeptemberTarget != 0 && unit_target.OctoberTarget != 0 && unit_target.NovemberTarget != 0 && unit_target.DecemberTarget != 0" data-target="#confirmSubmit">Add Target</button> 
                                </div> 
                            </div>

                            

                            <!-- Modal (Pop up when detail button clicked) FOR QUARTERTLY -->
                            <div  class="table-responsive" id="quarterlyform" style='display:none;'>
                                <table class="table">
                                    <td>
                                        <label for="quarterlyform" class="control-label">First Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_firstquarter_target" valid-number name="quarterlyform" autocomplete="off" class="form-control target-month" ng-model="quarter1" required ng-touched/>
                                        <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for First Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Second Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_secondquarter_target" valid-number name="quarterlyform" autocomplete="off" class="form-control target-month" ng-model="quarter2" required ng-touched/>
                                        <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Second Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Third Quarter:</label>
                                    </td>
                                    <td>
                                        <input type='text' id="id_thirdquarter_target" valid-number name="quarterlyform" autocomplete="off" class="form-control target-month" ng-model="quarter3" required ng-touched/>
                                        <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Third Quarter is required.</span>
                                    </td>

                                    <td>
                                        <label for="quarterlyform" class="control-label">Fourth Quarter:</label>
                                    </td>
                                    <td>

                                        <input type='text' id="id_fourthquarter_target" valid-number name="quarterlyform" autocomplete="off" class="form-control target-month" ng-model="quarter4" required ng-touched/>
                                        <span class="help-inline" ng-show="userForm.quarterlyform.$invalid && !userForm.quarterlyform.$pristine">Target for Fourth Quarter is required.</span>
                                    </td>
                                    <tr style="background-color:transparent;">
                                        <td colspan="8">
                                            <br />
                                            <div ng-show="info" class="alert alert-warning" ng-if="quarter1 != 0 &&  quarter2 != 0 && quarter3 != 0 && quarter4 != 0"><i class="fa fa-warning  fa-fw"></i> Please make sure that your input is correct. Once you "Add Target", you can no longer update it until next year.</div>
                                        </td>
                                    </tr>
                                </table>
                                    
                                                          
                                <div class="col-md-3 pull-right" style="margin-bottom:1em; margin-top:-1em;">
                                    <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save"  data-toggle="modal" data-target="#confirmSubmit" ng-if="quarter1 != 0 &&  quarter2 != 0 && quarter3 != 0 && quarter4 != 0" ng-disabled="frmEditTarget.$invalid">Add Target</button>
                                </div>
                            </div>
                                 <!-- ng-click="save(modalstate, id)" -->
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmSubmit" aria-hidden='true' aria-labelledby="myModalLabel" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <i class="fa fa-question fa-3x"></i>
                        <center>
                            <h4 class="modal-title">
                            Are you sure about this?
                            </h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                          
                            <div ng-if="istrue =='true'" class="alert alert-success">
                            <i class="fa fa-unlock  fa-fw">&nbsp;&nbsp;</i> Password confirmed! <br />
                            <i class="fa fa-paper-plane-o  fa-fw"></i> Click submit to continue. <br />

                            <i class="fa fa-info-circle fa-fw"></i> 
                            Once submitted you can no longer update it until next year.</div>

                            <div ng-if="istrue =='false'" class="alert alert-info">
                            <i class="fa fa-lock  fa-fw"></i>
                            Please type your password to confirm submission.
                            </div>


                            <input type="password" style="text-align:center; height: 2em; font-size:1.7em;" class="form-control" name="password" id="getPassword" placeholder="Password" ng-model="confirmPassword" ng-change="getpassword()"/> 
                        </div>
                    </div>
                

                    <div class="modal-footer">
                        <div class="col-md-12 alert alert-warning" style="text-align:left;">
                            <i class="fa fa-info-circle fa-fw"></i> 
                                To edit your target, click &times; on the right.
                        </div>
                        
                        <div class="pull-right">
                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal" ng-disabled="istrue == 'false'" ng-click="save(modalstate, id)"><i class="fa fa-paper-plane-o  fa-fw"></i> Submit</button>

                         </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="monthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>

                    <p class="alert alert-info">Monthly Targets for the Measure: <% unit_measurename %></p>
                    
                    <div class="modal-body table-responsive">
                        <form name="frmEditTarget" class="form-horizontal" novalidate="">
                            
                            <table class="table">
                                <tr ir-paginate='unit_target in unit_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
                                    <tr>
                                       
                                         <td><center>
                                                <div class="alert alert-info target_size">
                                                    <b>January: </b> <% unit_target.JanuaryTarget %>
                                                </div>
                                            </center>
                                        </td>

                                        <td><center>
                                                <div class="alert alert-info target_size">
                                                    <b>April: </b> <% unit_target.AprilTarget %>
                                                </div>                                         
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                               <div class="alert alert-info target_size">
                                                    <b>July: </b> <% unit_target.JulyTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>October: </b> <% unit_target.OctoberTarget %>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                       
                                         <td><center>
                                                <div class="alert alert-info target_size">
                                                    <b>February: </b> <% unit_target.FebruaryTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>May: </b> <% unit_target.MayTarget %>
                                                </div>
                                            </center>
                                        </td>

    
                                        <td><center>
                                                <div class="alert alert-info target_size">
                                                    <b>August: </b> <% unit_target.AugustTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>November: </b> <% unit_target.NovemberTarget %>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                       
                                         <td><center>
                                                <div class="alert alert-info target_size">
                                                    <b>March: </b> <% unit_target.MarchTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>June: </b> <% unit_target.JuneTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>September: </b> <% unit_target.SeptemberTarget %>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="alert alert-info target_size">
                                                    <b>December: </b> <% unit_target.DecemberTarget %>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    
                                </tr>
                                 
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>

       
        <div class="modal fade" id="quarterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>
                    <p class="control-label alert alert-info">Quarterly Targets for the Measure: <% unit_measurename %> </p>
                    
                    <div class="modal-body table-responsive">
                        <form name="frmEditTarget" novalidate="">
                            
                            <table class="table">
                                <tr>
                                    <td>
                                    <center>
                                        <div class="alert alert-info target_size">
                                            <b>1st Quarter: </b> <% firstquarter %>
                                        </div>
                                    </center>
                                    </td>
                                
                                    <td>
                                    <center>
                                        <div class="alert alert-info target_size">
                                            <b>2nd Quarter:</b> <% secondquarter %>
                                        </div>
                                    </center>
                                    </td>
                                
                                    <td>
                                    <center>
                                        <div class="alert alert-info target_size">
                                            <b>3rd Quarter:</b> <% thirdquarter %>
                                        </div>
                                    </center>
                                    </td>
                                
                                    <td>
                                    <center>
                                        <div class="alert alert-info target_size">
                                            <b>4th Quarter:</b> <% fourthquarter %>
                                        </div>
                                    </center>
                                    </td>
                                </tr>
                            </table>
                        </form>

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