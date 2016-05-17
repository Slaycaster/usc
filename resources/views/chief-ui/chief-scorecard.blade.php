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
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading measures-custom-heading">
                          <img class="img-responsive unitdashboard-custom-unitpic" src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
                          <h2 class="heading"><b>{{ $chief_user->chief->ChiefAbbreviation }} Scorecard for {{ date("Y") }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
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
                                            <b>TARGET/ACCOMPLISHMENT</b>
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
                                            <b>Actual</b>
                                        </td>
                                        <td class="objective-custom-td27">
                                            <b>Variance</b>
                                        </td>
                                    </tr>
                                        
                                    </thead>
                                    <tr ng-repeat='chief_target in chief_targets|filter:search'>
                                        
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %></td>

                                        <td><b><% chief_target.chief_measure.ChiefMeasureType %></b></td>
                                        

                                        <td><textarea rows="5" id="id_owner<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform"  value="<% chief_target.chief_owner.ChiefOwnerContent %>" ng-model="chief_target.chief_owner.ChiefOwnerContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><% chief_target.JanuaryTarget | number: 2 %></td>

                                        <td><% chief_target.FebruaryTarget | number: 2 %></td>

                                        <td><% chief_target.MarchTarget | number: 2 %></td>

                                        <td><% chief_target.AprilTarget | number: 2 %></td>

                                        <td><% chief_target.MayTarget | number: 2 %></td>

                                        <td><% chief_target.JuneTarget | number: 2 %></td>

                                        <td><% chief_target.JulyTarget | number: 2 %></td>

                                        <td><% chief_target.AugustTarget | number: 2 %></td>

                                        <td><% chief_target.SeptemberTarget | number: 2 %></td>

                                        <td><% chief_target.OctoberTarget | number: 2 %></td>

                                        <td><% chief_target.NovemberTarget | number: 2 %></td>

                                        <td><% chief_target.DecemberTarget | number: 2 %></td>

                                        <td><textarea rows="5" id="id_initiative<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" value="<% chief_target.chief_initiative.ChiefInitiativeContent %>" ng-model="chief_target.chief_initiative.ChiefInitiativeContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingEstimate %>" ng-model="chief_target.chief_funding.ChiefFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingActual %>" ng-model="chief_target.chief_funding.ChiefFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td></td>

                                         <input type="hidden" name="ChiefMeasureID" value="<%chief_target.chief_measure.ChiefMeasureID%>" id="chiefmeasure_id<%chief_target.chief_measure.ChiefMeasureID%>">
                                         <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" ng-model="chief_target.ChiefID" id="chief_id<%chief_target.chief_measure.ChiefMeasureID%>">
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

                </div> <!--div class col-lg-12 -->
            </div>
        </div>
    </div>




@endsection




