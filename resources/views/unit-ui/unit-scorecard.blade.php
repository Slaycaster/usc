@extends('layout-unit')
@section('content')

 	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <script src="{{ asset('js/stickyheader.js') }}"></script>

    <script src="{{ asset('js/debounce.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stickyheader.css') }}">
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_scorecard.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>
    
    <div ng-app="unitScorecardApp" ng-controller="APIUnitScorecardController">
    	<div id="wrap">
    		<div class="row">
    			<div class="panel panel-info scorecard-custom-panel">
    					<div class="panel-heading scorecard-custom-heading">

                          
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
						  
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $user->unit->UnitAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            

                                <div class="col-md-3 pull-right">
                                    <a href="{{ url('report/currentYearUnitScorecard') }}" target="_blank">
                                        <button type="button" class="btn btn-warning btn-sm pull-right" ><i class="fa fa-save fa-fw"></i>Generate Report</button>

                                    </a> 
                                </div>

                            </h2>
                            <div class="custom_scorecard-info">
                                <i ng-show="info"><span class="fa fa-list fa-fw"></span> Accomplishment last updated by: <b><% updatedby.user_unit.rank.RankCode %> <% updatedby.user_unit.UserUnitLastName %>, <% updatedby.user_unit.UserUnitFirstName %> on 
                                    <% updatedby.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-user fa-fw"></span> Owner last updated by: <b><% updatedby2.user_unit.rank.RankCode %> <% updatedby2.user_unit.UserUnitLastName %>, <% updatedby2.user_unit.UserUnitFirstName %> on 
                                    <% updatedby2.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br>
                                <i ng-show="info"><span class="fa fa-sitemap fa-fw"></span> Initiative last updated by: <b><% updatedby3.user_unit.rank.RankCode %> <% updatedby3.user_unit.UserUnitLastName %>, <% updatedby3.user_unit.UserUnitFirstName %> on 
                                    <% updatedby3.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-money fa-fw"></span> Funding last updated by: <b><% updatedby4.user_unit.rank.RankCode %> <% updatedby4.user_unit.UserUnitLastName %>, <% updatedby4.user_unit.UserUnitFirstName %> on 
                                    <% updatedby4.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i>        
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>

                            </div>

						</div><!--div panel-heading-->


						<div class="panel-body">
                            <div class="table-responsive tabledata" id="tabledata" style="display:none;">
    							<table class="table table-bordered floatThead-table">
    								<thead>
                                        <tr>
                                            <th rowspan="2">
                                                <input type="text" class="scorecard-objectives" value="OBJECTIVES" disabled/>
                                            </th>
                                    
                                            <th colspan="4">
                                                <center>MEASURES</center>
                                            </th>


                                            <th rowspan="2" class="thowner">
                                                <input type="text" class="scorecard-owner" value="OWNER" disabled/>
                                            </th>

                                            <th colspan="6">
                                                <center>TARGET/ACCOMPLISHMENT</center>
                                            </th>

                                            <th colspan="6">
                                                <center>TARGET/ACCOMPLISHMENT</center>
                                            </th>

                                            <th rowspan="2" class="thinitiatives">
                                                 <input type="text" class="scorecard-initiatives" value="INITIATIVES" disabled/>
                                            </th>
                                            <th colspan="3">
                                                <center>FUNDING</center>
                                            </th>
                                            <th rowspan="2" class="thlast">
                                                <input type="text" class="scorecard-action" value="Action" disabled/>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th colspan="2">
                                                <input type="text" class="scorecard-name" value="Name" disabled/>
                                            </th>

                                            <th>
                                            LG
                                            </th>
                                            <th>
                                            LD
                                            </th>
                                           

                                            <th>
                                                <input type="text" class="scorecard-month" value="January" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="February" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="March" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="April" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="May" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="June" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="July" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="August" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="September" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-month" value="October" disabled/>
                                            </th>
                                            <th>
                                                <input type="text"  class="scorecard-month" value="November" disabled/>
                                            </th>
                                            <th>
                                                <input type="text"  class="scorecard-month" value="December" disabled/>
                                            </th>
                                            
                                            <th>
                                                <input type="text" class="scorecard-estimate" value="Estimate" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-actual"  value="Actual" disabled/>
                                            </th>
                                            <th>
                                                <input type="text" class="scorecard-variance" value="Variance" disabled/>
                                            </th>
                                        </tr>
    								</thead>
    								<tr dir-paginate='unit_target in unit_targets|filter:search|itemsPerPage:5'>
                                        
                                        <td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %></td>

                                        <input type="hidden" value="<% unit_target.unit_measure.StaffMeasureID %>" ng-model="contributory" ng-init="c_measure=false" />

                                        <td colspan="2"><% unit_target.unit_measure.UnitMeasureName %>
                                            <span class="label label-danger" ng-if="c_measure=unit_target.unit_measure.StaffMeasureID">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                                        </td>

                                        <input type="hidden" ng-model="unittype" ng-init="c_type=unit_target.unit_measure.UnitMeasureType" />


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>


                                        <td><center><textarea rows="5" cols="27" id="id_owner<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_owner.UnitOwnerContent %>" ng-model="unit_target.unit_owner.UnitOwnerContent" autocomplete="off"  ng-touched ng-change="ownerchange()"></textarea></center></td>

                                        <td class="scorecard-month"><% unit_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jan<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JanuaryAccomplishment  %>" ng-model="unit_target.unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.FebruaryAccomplishment %>" ng-model="unit_target.unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MarchAccomplishment %>" ng-model="unit_target.unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AprilAccomplishment %>" ng-model="unit_target.unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MayAccomplishment %>" ng-model="unit_target.unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JuneAccomplishment %>" ng-model="unit_target.unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JulyAccomplishment %>" ng-model="unit_target.unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AugustAccomplishment %>" ng-model="unit_target.unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.SeptemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.OctoberAccomplishment %>" ng-model="unit_target.unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.NovemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% unit_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.DecemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_initiative.UnitInitiativeContent %>" ng-model="unit_target.unit_initiative.UnitInitiativeContent" autocomplete="off" ng-touched ng-change="initchange()"></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%unit_target.unit_measure.UnitMeasureID%>" class="scorecard-input-estimate" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingEstimate %>" ng-model="unit_target.unit_funding.UnitFundingEstimate" autocomplete="off" ng-touched ng-change="fundingchange()"/></td>
                                       
                                        <td><input type='text' id="id_actual<%unit_target.unit_measure.UnitMeasureID%>" class="scorecard-input-actual" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingActual %>" ng-model="unit_target.unit_funding.UnitFundingActual" autocomplete="off" ng-touched ng-change="fundingchange()"/></td>
                                        
                                        <td><% unit_target.unit_funding.UnitFundingEstimate - unit_target.unit_funding.UnitFundingActual | number: 2 %></td>

                                        <input type="hidden" name="UnitMeasureID" value="<%unit_target.unit_measure.UnitMeasureID%>" id="unitmeasure_id<%unit_target.unit_measure.UnitMeasureID%>" />
                                        <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id<%unit_target.unit_measure.UnitMeasureID%>" />
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id<%unit_target.unit_measure.UnitMeasureID%>" />
                                        
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