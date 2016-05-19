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
    							<table class="table table-bordered floatThead-table">
    								<thead>
                                        <tr>
                                            <td rowspan="2">
                                                <input type="text" class="scorecard-objectives" value="OBJECTIVES" disabled/>
                                            </td>
                                    
                                            <td colspan="3">
                                                MEASURES
                                            </td>


                                            <td rowspan="2">
                                                <input type="text" class="scorecard-owner" value="OWNER" disabled/>
                                            </td>

                                            <td colspan="12">
                                                TARGET/ACCOMPLISHMENT
                                            </td>

                                            <td rowspan="2">
                                                 <input type="text" class="scorecard-initiatives" value="INITIATIVES" disabled/>
                                            </td>
                                            <td colspan="3">
                                                FUNDING
                                            </td>
                                            <td rowspan="2">
                                                <input type="text" class="scorecard-action" value="Action" disabled/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <input type="text" class="scorecard-name" value="Name" disabled/>
                                            </td>

                                            <td>
                                                Type
                                            </td>
                                           

                                            <td>
                                                <input type="text" class="scorecard-month" value="January" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="February" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="March" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="April" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="May" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="June" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="July" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="August" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="September" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-month" value="October" disabled/>
                                            </td>
                                            <td>
                                                <input type="text"  class="scorecard-month" value="November" disabled/>
                                            </td>
                                            <td>
                                                <input type="text"  class="scorecard-month" value="December" disabled/>
                                            </td>
                                            
                                            <td>
                                                <input type="text" class="scorecard-estimate" value="Estimate" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-actual"  value="Actual" disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="scorecard-variance" value="Variance" disabled/>
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
                                        


                                        <td><textarea rows="5" cols="30" id="id_owner<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_owner.UnitOwnerContent %>" ng-model="unit_target.unit_owner.UnitOwnerContent" autocomplete="off"  ng-touched /></textarea></td>

                                        <td class="scorecard-month"><% unit_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jan<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JanuaryAccomplishment  %>" ng-model="unit_target.unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.FebruaryAccomplishment %>" ng-model="unit_target.unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MarchAccomplishment %>" ng-model="unit_target.unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AprilAccomplishment %>" ng-model="unit_target.unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MayAccomplishment %>" ng-model="unit_target.unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JuneAccomplishment %>" ng-model="unit_target.unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JulyAccomplishment %>" ng-model="unit_target.unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AugustAccomplishment %>" ng-model="unit_target.unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.SeptemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.OctoberAccomplishment %>" ng-model="unit_target.unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.NovemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.DecemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td><textarea rows="5" cols="30" id="id_initiative<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_initiative.UnitInitiativeContent %>" ng-model="unit_target.unit_initiative.UnitInitiativeContent" autocomplete="off" ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingEstimate %>" ng-model="unit_target.unit_funding.UnitFundingEstimate" autocomplete="off" class="form-control scorecard-input-estimate" ng-touched /></td>
                                        <td ><input type='text' id="id_actual<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingActual %>" ng-model="unit_target.unit_funding.UnitFundingActual" autocomplete="off" class="form-control scorecard-input-actual" ng-touched /></td>
                                        
                                        <td><%unit_target.unit_funding.UnitFundingEstimate - unit_target.unit_funding.UnitFundingActual %></td>

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