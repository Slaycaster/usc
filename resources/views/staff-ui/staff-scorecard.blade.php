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
    			<div class="col-lg-12 col-md-12 col-xs-12">
    				<div class="panel panel-info">
    					<div class="panel-heading measures-custom-heading">
						  <img class="img-responsive unitdashboard-custom-unitpic" src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
						  <h2 class="heading"><b>{{ $staff_user->staff->StaffAbbreviation }} Scorecard for {{ date("Y") }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div><!--div panel-heading-->

						<div class="panel-body">
							<div class="table-responsive" >
    							<table class="table table-striped table-bordered">
    								<thead>
                                    <tr>
                                        <td class="objective-custom-td1" rowspan="2">
                                            <b>OBJECTIVES</b>
                                        </td>
                                
                                        <td class="objective-custom-td2" colspan="3">
                                            <b>MEASURES</b>
                                        </td>


                                        <td class="objective-custom-td3" rowspan="2" >
                                            <b>OWNER</b>
                                        </td>

                                        <td class="objective-custom-td4" colspan="12">
                                            <b>TARGET/ACCUMULATION</b>
                                        </td>

                                        <td class="objective-custom-td5" rowspan="2">
                                            <b>INITIATIVES</b>
                                        </td>
                                        <td class="objective-custom-td6" colspan="3">
                                            <b>FUNDING</b>
                                        </td>
                                         <td class="objective-custom-td7" rowspan="2">
                                            <b>Action</b>
                                        </td>
                                    </tr>

                                    <tr>
                                        
                                
                                        <td class="objective-custom-td8" colspan="2">
                                            <b>Name</b>
                                        </td>

                                        <td class="objective-custom-td9">
                                            <b>Type</b>
                                        </td>
                                       

                                        <td class="objective-custom-td12">
                                            <b>Jan</b>
                                        </td>
                                        <td class="objective-custom-td13">
                                            <b>Feb</b>
                                        </td>
                                        <td class="objective-custom-td14">
                                            <b>Mar</b>
                                        </td>
                                        <td class="objective-custom-td15">
                                            <b>Apr</b>
                                        </td>
                                        <td class="objective-custom-td16">
                                            <b>May</b>
                                        </td>
                                        <td class="objective-custom-td17">
                                            <b>Jun</b>
                                        </td>
                                        <td class="objective-custom-td18">
                                            <b>Jul</b>
                                        </td>
                                        <td class="objective-custom-td19">
                                            <b>Aug</b>
                                        </td>
                                        <td class="objective-custom-td20">
                                            <b>Sep</b>
                                        </td>
                                        <td class="objective-custom-td21">
                                            <b>Oct</b>
                                        </td>
                                        <td class="objective-custom-td22">
                                            <b>Nov</b>
                                        </td>
                                        <td class="objective-custom-td23">
                                            <b>Dec</b>
                                        </td>
                                        
                                        <td class="objective-custom-td25">
                                            <b>Estimate</b>
                                        </td>
                                        <td class="objective-custom-td26">
                                            <b>Actual(sss)</b>
                                        </td>
                                        <td class="objective-custom-td27">
                                            <b>Variance</b>
                                        </td>
                                    </tr>
    									
    								</thead>
    								<tr dir-paginate='staff_target in staff_targets|filter:search|itemsPerPage:5'>
    									
                                        <td><% staff_target.staff_measure.staff_objective.StaffObjectiveName %>
                                            </td>

                                        <input type="hidden" value="<% staff_target.staff_measure.ChiefMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% staff_target.staff_measure.StaffMeasureName %>
                                        <span class="label label-info" ng-if="c_measure=staff_target.staff_measure.ChiefMeasureID">Contributory</span>
                                    </td>


                                        <td><b><% staff_target.staff_measure.StaffMeasureType %></b></td>
                                        


                                        <td><textarea rows="5" id="id_owner" name="owner[]" value="<% staff_target.staff_owner.StaffOwnerContent %>" ng-model="staff_target.staff_owner.StaffOwnerContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><% staff_target.JanuaryTarget | number: 2 %>/<input type='text' id="id_jan" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JanuaryAccomplishment  %>" ng-model="staff_target.staff_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.FebruaryTarget | number: 2 %>/<input type='text' id="id_feb" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.FebruaryAccomplishment %>" ng-model="staff_target.staff_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.MarchTarget | number: 2 %>/<input type='text' id="id_mar" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MarchAccomplishment %>" ng-model="staff_target.staff_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.AprilTarget | number: 2 %>/<input type='text' id="id_apr" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AprilAccomplishment %>" ng-model="staff_target.staff_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.MayTarget | number: 2 %>/<input type='text' id="id_may" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MayAccomplishment %>" ng-model="staff_target.staff_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.JuneTarget | number: 2 %>/<input type='text' id="id_jun" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JuneAccomplishment %>" ng-model="staff_target.staff_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.JulyTarget | number: 2 %>/<input type='text' id="id_jul" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JulyAccomplishment %>" ng-model="staff_target.staff_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.AugustTarget | number: 2 %>/<input type='text' id="id_aug" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AugustAccomplishment %>" ng-model="staff_target.staff_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.SeptemberTarget | number: 2 %>/<input type='text' id="id_sep" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.SeptemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.OctoberTarget | number: 2 %>/<input type='text' id="id_oct" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.OctoberAccomplishment %>" ng-model="staff_target.staff_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.NovemberTarget | number: 2 %>/<input type='text' id="id_nov" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.NovemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% staff_target.DecemberTarget | number: 2 %>/<input type='text' id="id_dec" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.DecemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><textarea rows="5" id="id_initiative" name="monthlyform" value="<% staff_target.staff_initiative.StaffInitiativeContent %>" ng-model="staff_initiative.staffInitiativeContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingEstimate %>" ng-model="staff_funding.StaffFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td ><input type='text' id="id_actual" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingActual %>" ng-model="staff_funding.StaffFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td ></td>

                                         <input type="hidden" name="StaffMeasureID" value="<%staff_target.staff_measure.StaffMeasureID%>" id="staffmeasure_id">
    									 <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id">
                                        <input type="hidden" name="UserStaffID" value="<?=$staff_user->UserStaffID?>" id="user_staff_id">
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

    			</div> <!--div class col-lg-12 -->
    		</div>
    	</div>
    </div>
@endsection