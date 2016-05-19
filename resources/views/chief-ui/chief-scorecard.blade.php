@extends('layout-chief')
@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/chief_scorecard.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIChiefScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                            <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
                          
                            <h2 class="heading">
                                <b>{{ $chief_user->chief->ChiefAbbreviation }} Scorecard for {{ date("Y") }}
                                </b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div><!--div panel-heading-->

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                    <tr ng-repeat='chief_target in chief_targets|filter:search'>
                                        
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %><br /><i style="font-size:10px;">Contributory/ies to this Measure</i>
                                            <br /><!--Contributory Accomplishment--><p class="scorecard-minilabel" ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                            <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>
                                        </td>

                                        <td style="text-align:center;"><b><% chief_target.chief_measure.ChiefMeasureType %></b></td>
                                        

                                        <td>
                                            <textarea rows="5" cols="30" id="id_owner<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform"  value="<% chief_target.chief_owner.ChiefOwnerContent %>" ng-model="chief_target.chief_owner.ChiefOwnerContent" autocomplete="off"  required ng-touched></textarea>
                                        </td>

                                        <td><% chief_target.JanuaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong><span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span></p>

                                        </td>

                                        <td><% chief_target.FebruaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.MarchTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.AprilTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.MayTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.JuneTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.JulyTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.AugustTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.SeptemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.OctoberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.NovemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.DecemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><textarea rows="5" cols="25" id="id_initiative<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" value="<% chief_target.chief_initiative.ChiefInitiativeContent %>" ng-model="chief_target.chief_initiative.ChiefInitiativeContent" autocomplete="off"  required ng-touched ></textarea></td>

                                        <td><input type='text' id="id_estimate<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingEstimate %>" ng-model="chief_target.chief_funding.ChiefFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingActual %>" ng-model="chief_target.chief_funding.ChiefFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td></td>

                                         <input type="hidden" name="ChiefMeasureID" value="<%chief_target.chief_measure.ChiefMeasureID%>" id="chiefmeasure_id<%chief_target.chief_measure.ChiefMeasureID%>" />
                                         <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" ng-model="chief_target.ChiefID" id="chief_id<%chief_target.chief_measure.ChiefMeasureID%>" />
                                        <input type="hidden" name="UserChiefID" value="<?=$chief_user->UserChiefID?>" ng-model="chief_target.UserChiefID" id="user_chief_id<%chief_target.chief_measure.ChiefMeasureID%>">
                                        <td>
                                            
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, chief_target.ChiefTargetID)"><span class="fa fa-save fa-fw"></span> Save Changes</button>
                                            
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <!--./table table striped-->
                            <br>
                                 
                            
                        </div><!-- div panel-body-->
                </div><!--div panel panel-info-->
            </div>
        </div>
    </div>

@endsection
