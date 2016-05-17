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
                                            TARGET/ACCUMULATION
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
                                    <tr dir-paginate='chief_target in chief_targets|filter:search|itemsPerPage:5'>
                                        
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %></td>


                                        <td><b><% chief_target.chief_measure.ChiefMeasureType %></b></td>
                                        

                                        <td><textarea rows="5" id="id_owner" name="monthlyform"  value="<% chief_target.chief_owner.ChiefOwnerContent %>" ng-model="chief_target.chief_owner.ChiefOwnerContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><% chief_target.JanuaryTarget | number: 2 %>/<input type='text' id="id_jan" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.JanuaryAccomplishment  %>" ng-model="chief_target.chief_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.FebruaryTarget | number: 2 %>/<input type='text' id="id_feb" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.FebruaryAccomplishment %>" ng-model="chief_target.chief_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.MarchTarget | number: 2 %>/<input type='text' id="id_mar" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.MarchAccomplishment %>" ng-model="chief_target.chief_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.AprilTarget | number: 2 %>/<input type='text' id="id_apr" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.AprilAccomplishment %>" ng-model="chief_target.chief_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.MayTarget | number: 2 %>/<input type='text' id="id_may" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.MayAccomplishment %>" ng-model="chief_target.chief_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.JuneTarget | number: 2 %>/<input type='text' id="id_jun" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.JuneAccomplishment %>" ng-model="chief_target.chief_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.JulyTarget | number: 2 %>/<input type='text' id="id_jul" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.JulyAccomplishment %>" ng-model="chief_target.chief_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.AugustTarget | number: 2 %>/<input type='text' id="id_aug" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.AugustAccomplishment %>" ng-model="chief_target.chief_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.SeptemberTarget | number: 2 %>/<input type='text' id="id_sep" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.SeptemberAccomplishment %>" ng-model="chief_target.chief_accomplishment.SeptemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.OctoberTarget | number: 2 %>/<input type='text' id="id_oct" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.OctoberAccomplishment %>" ng-model="chief_target.chief_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.NovemberTarget | number: 2 %>/<input type='text' id="id_nov" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.NovemberAccomplishment %>" ng-model="chief_target.chief_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.DecemberTarget | number: 2 %>/<input type='text' id="id_dec" name="monthlyform" valid-number value="<% chief_target.chief_accomplishment.DecemberAccomplishment %>" ng-model="chief_target.chief_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><textarea rows="5" id="id_initiative" name="monthlyform" value="<% chief_target.chief_initiative.ChiefInitiativeContent %>" ng-model="chief_target.chief_initiative.ChiefInitiativeContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingEstimate %>" ng-model="chief_target.chief_funding.ChiefFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><input type='text' onclick="myFunction()" id="id_actual" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingActual %>" ng-model="chief_target.chief_funding.ChiefFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td></td>
                                         <input type="hidden" name="ChiefMeasureID" value="<%chief_target.chief_measure.ChiefMeasureID%>" id="chiefmeasure_id">
                                         <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" id="chief_id">
                                        <input type="hidden" name="UserChiefID" value="<?=$chief_user->UserChiefID?>" id="user_chief_id" >
                                        <td>
                                            
                                               <button type="button"  class="btn btn-success" style=' font-size:15px; padding-top:10px; padding-bottom:10px; ' id="btn-save" ng-click="save(modalstate, chief_target.ChiefTargetID)">Save Changes</button>
                                            
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




