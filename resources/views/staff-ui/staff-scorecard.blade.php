@extends('layout-staff')
@section('content')

 	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_scorecard.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIStaffScorecardController">
    	<div id="wrap">
    		<div class="row">
    			<div class="panel panel-info scorecard-custom-panel">
    					<div class="panel-heading scorecard-custom-heading">
						  <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
						  
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $staff_user->staff->StaffAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div><!--div panel-heading-->

						<div class="panel-body">
							<div class="table-responsive" >
    							<table class="table table-striped table-bordered">
    								<thead>
                                    <tr>
                                        <td class="objective-custom-td1" rowspan="2">
                                            OBJECTIVES
                                        </td>
                                
                                        <td class="objective-custom-td2" colspan="3">
                                            MEASURES
                                        </td>

                                        <td class="objective-custom-td3" rowspan="2" >
                                            OWNER
                                        </td>

                                        <td class="objective-custom-td4" colspan="12">
                                            <b>TARGET/ACCOMPLISHMENT</b>
                                        </td>

                                        <td class="objective-custom-td5" rowspan="2">
                                            INITIATIVES
                                        </td>
                                        <td class="objective-custom-td6" colspan="3">
                                            FUNDING
                                        </td>
                                         <td class="objective-custom-td7" rowspan="2">
                                            Action
                                        </td>
                                    </tr>

                                    <tr>
                                        
                                
                                        <td class="objective-custom-td8" colspan="2">
                                            Name
                                        </td>

                                        <td class="objective-custom-td9">
                                            Type
                                        </td>
                                       

                                        <td class="objective-custom-td12">
                                            Jan
                                        </td>
                                        <td class="objective-custom-td13">
                                            Feb
                                        </td>
                                        <td class="objective-custom-td14">
                                            Mar
                                        </td>
                                        <td class="objective-custom-td15">
                                            Apr
                                        </td>
                                        <td class="objective-custom-td16">
                                            May
                                        </td>
                                        <td class="objective-custom-td17">
                                            Jun
                                        </td>
                                        <td class="objective-custom-td18">
                                            Jul
                                        </td>
                                        <td class="objective-custom-td19">
                                            Aug
                                        </td>
                                        <td class="objective-custom-td20">
                                            Sep
                                        </td>
                                        <td class="objective-custom-td21">
                                            Oct
                                        </td>
                                        <td class="objective-custom-td22">
                                            Nov
                                        </td>
                                        <td class="objective-custom-td23">
                                            Dec
                                        </td>
                                        
                                        <td class="objective-custom-td25">
                                            Estimate
                                        </td>
                                        <td class="objective-custom-td26">
                                            Actual(sss)
                                        </td>
                                        <td class="objective-custom-td27">
                                            Variance
                                        </td>
                                    </tr>
    									
    								</thead>
    								<tr dir-paginate='staff_target in staff_targets|filter:search|itemsPerPage:5'>
    									
                                        <td><% staff_target.staff_measure.staff_objective.StaffObjectiveName %>
                                            </td>

                                        <input type="hidden" value="<% staff_target.staff_measure.ChiefMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% staff_target.staff_measure.StaffMeasureName %>
                                        <span class="label label-primary" ng-if="c_measure=staff_target.staff_measure.ChiefMeasureID">Contributory to C, PNP</span>

                                         <i style="font-size:10px;">Contributory/ies to this Measure</i>
                                            <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>
                                    </td>


                                        <td><b><% staff_target.staff_measure.StaffMeasureType %></b></td>
                                        

                                        <td><textarea rows="5" id="id_owner<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" value="<% staff_target.staff_owner.StaffOwnerContent %>" ng-model="staff_target.staff_owner.StaffOwnerContent" autocomplete="off"  ng-touched /></textarea></td>

                                        <td><% staff_target.JanuaryTarget | number: 2 %>/<input type='text' id="id_jan<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JanuaryAccomplishment  %>" ng-model="staff_target.staff_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                            <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JanuaryAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.FebruaryTarget | number: 2 %>/<input type='text' id="id_feb<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.FebruaryAccomplishment %>" ng-model="staff_target.staff_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                            <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].FebruaryAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.MarchTarget | number: 2 %>/<input type='text' id="id_mar<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MarchAccomplishment %>" ng-model="staff_target.staff_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].MarchAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.AprilTarget | number: 2 %>/<input type='text' id="id_apr<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AprilAccomplishment %>" ng-model="staff_target.staff_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].AprilAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.MayTarget | number: 2 %>/<input type='text' id="id_may<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MayAccomplishment %>" ng-model="staff_target.staff_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].MayAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.JuneTarget | number: 2 %>/<input type='text' id="id_jun<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JuneAccomplishment %>" ng-model="staff_target.staff_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JuneAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.JulyTarget | number: 2 %>/<input type='text' id="id_jul<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JulyAccomplishment %>" ng-model="staff_target.staff_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JulyAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.AugustTarget | number: 2 %>/<input type='text' id="id_aug<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AugustAccomplishment %>" ng-model="staff_target.staff_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].AugustAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.SeptemberTarget | number: 2 %>/<input type='text' id="id_sep<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.SeptemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].SeptemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.OctoberTarget | number: 2 %>/<input type='text' id="id_oct<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.OctoberAccomplishment %>" ng-model="staff_target.staff_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].OctoberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.NovemberTarget | number: 2 %>/<input type='text' id="id_nov<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.NovemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].NovemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.DecemberTarget | number: 2 %>/<input type='text' id="id_dec<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.DecemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].DecemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>
>>>>>>> 93fc2b72f048aaf1b56b3847272d4d7a36b6268d

                                        </td>

<<<<<<< HEAD
                                        <td><input type='text' id="id_estimate" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingEstimate %>" ng-model="staff_funding.StaffFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td ><input type='text' id="id_actual" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingActual %>" ng-model="staff_funding.StaffFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
=======
                                        <td><textarea rows="5" id="id_initiative<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" value="<% staff_target.staff_initiative.StaffInitiativeContent %>" ng-model="staff_target.staff_initiative.StaffInitiativeContent" autocomplete="off" ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingEstimate %>" ng-model="staff_target.staff_funding.StaffFundingEstimate" autocomplete="off" class="form-control" ng-touched /></td>
                                        <td ><input type='text' id="id_actual<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingActual %>" ng-model="staff_target.staff_funding.StaffFundingActual" autocomplete="off" class="form-control" ng-touched /></td>
>>>>>>> 93fc2b72f048aaf1b56b3847272d4d7a36b6268d
                                        <td ></td>

                                         <input type="hidden" name="StaffMeasureID" value="<%staff_target.staff_measure.StaffMeasureID%>" id="staffmeasure_id<%staff_target.staff_measure.StaffMeasureID%>">
    									 <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id<%staff_target.staff_measure.StaffMeasureID%>">
                                        <input type="hidden" name="UserStaffID" value="<?=$staff_user->UserStaffID?>" id="user_staff_id<%staff_target.staff_measure.StaffMeasureID%>">
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, staff_target.StaffTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
                                         </td>
    								</tr>
    							</table>

                            </div>
                            <!--./table table striped-->
                            <br>
                                
                            <center>
								<dir-pagination-controls
							       max-size="7"
							       direction-links="true"
							       boundary-links="true" >
							    </dir-pagination-controls>
							    <!--./dir-pagination-controls-->
							</center>
						</div><!-- div panel-body-->
    			</div><!--div panel panel-info-->
    		</div>
    	</div>
    </div>
@endsection