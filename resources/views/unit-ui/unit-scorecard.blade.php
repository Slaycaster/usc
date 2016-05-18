@extends('layout-unit')
@section('content')

 	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_scorecard.js') }}"></script>

    <script src="{{ asset('js/stickyheader.js') }}"></script>
    
    <div ng-app="unitScorecardApp" ng-controller="APIUnitScorecardController">
    	<div id="wrap">
    		<div class="row">
    			<div class="panel panel-info scorecard-custom-panel">
    					<div class="panel-heading scorecard-custom-heading">
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
						  
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $user->unit->UnitAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>

						</div><!--div panel-heading-->


						<div class="panel-body">
							<div class="table-responsive" >
    							<table class="table table-striped table-bordered floatThead-table">
    								<thead>
                                        <tr>
                                            <td class="scorecard-objective" rowspan="2" width="10em;">
                                                OBJECTIVES
                                            </td>
                                    
                                            <td class="objective-custom-td2" colspan="3">
                                                MEASURES
                                            </td>


                                            <td class="objective-custom-td3" rowspan="2" >
                                                OWNER
                                            </td>

                                            <td class="objective-custom-td4" colspan="12">
                                                TARGET/ACCOMPLISHMENT
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
                                                Actual
                                            </td>
                                            <td class="objective-custom-td27">
                                                Variance
                                            </td>
                                        </tr>	
    								</thead>
    								<tr dir-paginate='unit_target in unit_targets|filter:search|itemsPerPage:5'>
                                        
                                        <td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %>
                                            </td>

                                        <input type="hidden" value="<% unit_target.unit_measure.StaffMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% unit_target.unit_measure.UnitMeasureName %>
                                            <span class="label label-danger" ng-if="c_measure=unit_target.unit_measure.StaffMeasureID">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                                        </td>


                                        <td class="scorecard-type"><b><% unit_target.unit_measure.UnitMeasureType %></b></td>
                                        


                                        <td><textarea rows="5" id="id_owner<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_owner.UnitOwnerContent %>" ng-model="unit_target.unit_owner.UnitOwnerContent" autocomplete="off"  ng-touched /></textarea></td>

                                        <td class="scorecard-month"><% unit_target.JanuaryTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_jan<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JanuaryAccomplishment  %>" ng-model="unit_target.unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.FebruaryTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_feb<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.FebruaryAccomplishment %>" ng-model="unit_target.unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MarchTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_mar<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MarchAccomplishment %>" ng-model="unit_target.unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AprilTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_apr<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AprilAccomplishment %>" ng-model="unit_target.unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MayTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_may<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MayAccomplishment %>" ng-model="unit_target.unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JuneTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_jun<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JuneAccomplishment %>" ng-model="unit_target.unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JulyTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_jul<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JulyAccomplishment %>" ng-model="unit_target.unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AugustTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_aug<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AugustAccomplishment %>" ng-model="unit_target.unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.SeptemberTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_sep<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.SeptemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.OctoberTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_oct<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.OctoberAccomplishment %>" ng-model="unit_target.unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.NovemberTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_nov<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.NovemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.DecemberTarget | number: 2 %>/<input type='text' style="width:4.5em; text-align:center;" id="id_dec<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.DecemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td><textarea rows="5" id="id_initiative<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_initiative.UnitInitiativeContent %>" ng-model="unit_target.unit_initiative.UnitInitiativeContent" autocomplete="off" ng-touched /></textarea></td>

                                        <td><input type='text' style="width:5em;" id="id_estimate<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingEstimate %>" ng-model="unit_target.unit_funding.UnitFundingEstimate" autocomplete="off" class="form-control" ng-touched /></td>
                                        <td ><input type='text' style="width:5em;" id="id_actual<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingActual %>" ng-model="unit_target.unit_funding.UnitFundingActual" autocomplete="off" class="form-control" ng-touched /></td>
                                        
                                        <td></td>

                                         <input type="hidden" name="UnitMeasureID" value="<%unit_target.unit_measure.UnitMeasureID%>" id="unitmeasure_id<%unit_target.unit_measure.UnitMeasureID%>">
                                         <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id<%unit_target.unit_measure.UnitMeasureID%>">
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id<%unit_target.unit_measure.UnitMeasureID%>">
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, unit_target.UnitTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
                                        </td>
                                    </tr>
    							</table>

                            </div>
                            <!--./table table striped-->
                            
						</div><!-- div panel-body-->
    			</div><!--div panel panel-info-->
    		</div>
    	</div>
    </div>
@endsection