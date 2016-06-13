@extends('layout-tertiary-unit')
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
    <script src="{{ asset('app/controllers/tertiary_unit_scorecard.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>
    
    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">

                          
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/tertiaryunitpictures/cropped/'.''.$user->tertiary_unit->PicturePath.'') }}">
                          
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $user->tertiary_unit->TertiaryUnitAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            

                                <div class="col-md-3 pull-right">
                                    <form method="get" action="{{ url('report/currentYearTertiaryUnitScorecard') }}" target="_blank">
                                        <button type="submit" class="btn btn-warning btn-sm pull-right" name="total" value="total"><i class="fa fa-save fa-fw"></i>Generate Report (Total)</button>
                                       
                                    </form>
                                </div>

                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            <div class="custom_scorecard-info" id="tableinfo">
                                <i ng-show="info"><span class="fa fa-list fa-fw"></span> Accomplishment last updated by: <b><% updatedby.user_tertiary_unit.rank.RankCode %> <% updatedby.user_tertiary_unit.UserTertiaryUnitLastName %>, <% updatedby.user_tertiary_unit.UserTertiaryUnitFirstName %> on 
                                    <% updatedby.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-user fa-fw"></span> Owner last updated by: <b><% updatedby2.user_tertiary_unit.rank.RankCode %> <% updatedby2.user_tertiary_unit.UserTertiaryUnitLastName %>, <% updatedby2.user_tertiary_unit.UserTertiaryUnitFirstName %> on 
                                    <% updatedby2.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br>
                                <i ng-show="info"><span class="fa fa-sitemap fa-fw"></span> Initiative last updated by: <b><% updatedby3.user_tertiary_unit.rank.RankCode %> <% updatedby3.user_tertiary_unit.UserTertiaryUnitLastName %>, <% updatedby3.user_tertiary_unit.UserTertiaryUnitFirstName %> on 
                                    <% updatedby3.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i ng-show="info"><span class="fa fa-money fa-fw"></span> Funding last updated by: <b><% updatedby4.user_tertiary_unit.rank.RankCode %> <% updatedby4.user_tertiary_unit.UserTertiaryUnitLastName %>, <% updatedby4.user_tertiary_unit.UserTertiaryUnitFirstName %> on 
                                    <% updatedby4.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i>        
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>

                            </div>

                        </div><!--div panel-heading-->


                        <div class="panel-body">
                            <div class="table-responsive tabledata" id="tabledata">
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
                                    <tr ng-repeat='tertiary_unit_target in tertiary_unit_targets|filter:search'>
                                        
                                        <td><% tertiary_unit_target.tertiary_unit_measure.tertiary_unit_objective.TertiaryUnitObjectiveName %></td>

                                        <input type="hidden" value="<% tertiary_unit_target.tertiary_unit_measure.SecondaryUnitMeasureID %>" ng-model="contributory" ng-init="c_measure=false" />

                                        <td colspan="2"><% tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureName %>
                                           <br/> <span class="label label-danger" ng-if="c_measure=tertiary_unit_target.tertiary_unit_measure.SecondaryUnitMeasureID">Contributory to {{ $user->tertiary_unit->secondary_unit->SecondaryUnitAbbreviation }}</span>
                                        </td>

                                        <input type="hidden" ng-model="unittype" ng-init="c_type=tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureType" />


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>


                                        <td><center><textarea rows="5" cols="27" id="id_owner<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" value="<% tertiary_unit_target.tertiary_unit_owner.TertiaryUnitOwnerContent %>" ng-model="tertiary_unit_target.tertiary_unit_owner.TertiaryUnitOwnerContent" autocomplete="off"  ng-touched ng-change="ownerchange()"></textarea></center></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jan<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.JanuaryAccomplishment  %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.FebruaryAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.MarchAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.AprilAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.MayAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.JuneAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.JulyAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.AugustAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.SeptemberAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.OctoberAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.NovemberAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td class="scorecard-month"><% tertiary_unit_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_accomplishment.DecemberAccomplishment %>" ng-model="tertiary_unit_target.tertiary_unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/></td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%tertiary_unit_target.TertiaryUnitTargetID%>" name="monthlyform" value="<% tertiary_unit_target.tertiary_unit_initiative.TertiaryUnitInitiativeContent %>" ng-model="tertiary_unit_target.tertiary_unit_initiative.TertiaryUnitInitiativeContent" autocomplete="off" ng-touched ng-change="initchange()"></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%tertiary_unit_target.TertiaryUnitTargetID%>" class="scorecard-input-estimate" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate %>" ng-model="tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate" autocomplete="off" ng-touched ng-change="fundingchange()"/></td>
                                       
                                        <td><input type='text' id="id_actual<%tertiary_unit_target.TertiaryUnitTargetID%>" class="scorecard-input-actual" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual %>" ng-model="tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual" autocomplete="off" ng-touched ng-change="fundingchange()"/></td>
                                        
                                        <td><% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate - tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual | number: 2 %></td>

                                        <input type="hidden" name="TertiaryUnitMeasureID" value="<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" id="unitmeasure_id<%tertiary_unit_target.TertiaryUnitTargetID%>" />
                                        <input type="hidden" name="TertiaryUnitID" value="<?=$user->tertiary_unit->TertiaryUnitID?>" id="unit_id<%tertiary_unit_target.TertiaryUnitTargetID%>" />
                                        <input type="hidden" name="UserTertiaryUnitID" value="<?=$user->UserTertiaryUnitID?>" id="user_unit_id<%tertiary_unit_target.TertiaryUnitTargetID%>" />
                                        
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, tertiary_unit_target.TertiaryUnitTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
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