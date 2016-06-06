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
    <script src="{{ asset('app/controllers/tertiary_scorecard.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                            <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/tertiaryunitpictures/cropped/'.''.$user->tertiary_unit->PicturePath.'') }}">
                          
                            <h2 class="heading">
                                <b>{{ $user->tertiary_unit->TertiaryUnitAbbreviation }} Scorecard for {{ date("Y") }}
                                </b>
                                <div class="col-md-5 pull-right">
                                    <form method="get" action="{{ url('report/currentYearTertiaryScorecard') }}" target="_blank">
                                        <button type="submit" class="btn btn-warning btn-sm pull-right" name="breakdown" value="breakdown"><i class="fa fa-save fa-fw"></i>Generate Report (Breakdown)</button>
                                        <button type="submit" class="btn btn-warning btn-sm pull-right" name="total" value="total"><i class="fa fa-save fa-fw"></i>Generate Report (Total)</button>
                                    </form>
                                </div>

                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div><!--div panel-heading-->

                        <div class="panel-body">
                            <div class="table-responsive tabledata" id="tabledata">
                                <table class="table table-bordered">
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

                                        <th rowspan="2">
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
                                            <input type="text" class="scorecard-estimate" value="Estimate" data-toggle="tooltip" data-placement="top" title="This is the estimate!" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-actual"  value="Actual" data-toggle="tooltip" data-placement="top" title="This is the actual!" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-variance" value="Variance" 
                                            data-toggle="tooltip" data-placement="top" title="This is the variance!"disabled/>
                                        </th>
                                    </tr>
                                        
                                    </thead>
                                    <tr ng-repeat='tertiary_unit_target in tertiary_unit_targets|filter:search'>
                                        
                                        <td><% tertiary_unit_target.tertiary_unit_measure.tertiary_unit_objective.TertiaryObjectiveName %></td>

                                        <td colspan="2"><% tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureName %><br /><i style="font-size:10px;">Contributory/ies to this Measure</i><!--Contributory Accomplishment--><br /><p style="display: inline" class="scorecard-minilabel" ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                            <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>
                                        </td>


                                        <input type="hidden" ng-model="tertiarytype" ng-init="c_type=tertiary_unit_target.tertiary_unit_measure.TertiaryMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>
                                        

                                        <td><center>
                                            <textarea rows="5" cols="27" id="id_owner<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" name="monthlyform"  value="<% tertiary_unit_target.tertiary_unit_owner.TertiaryUnitOwnerContent %>" ng-model="tertiary_unit_target.tertiary_unit_owner.TertiaryUnitOwnerContent" autocomplete="off"  required ng-touched></textarea>
                                            </center>
                                        </td>

                                        <td><% tertiary_unit_target.JanuaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                           <input type="hidden" ng-model="january" ng-init="c_january=tertiary_unit_january[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_january != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#janModal<% $index %>"><% tertiary_unit_january[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="janModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="january=staff_measure.staff_accomplishments[0].JanuaryAccomplishment">
                                                                            <div ng-if="january!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                        </td>

                                        <td><% tertiary_unit_target.FebruaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="february" ng-init="c_february=tertiary_unit_february[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_february != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#febModal<% $index %>"><% tertiary_unit_february[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="febModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="february=staff_measure.staff_accomplishments[0].FebruaryAccomplishment">
                                                                            <div ng-if="february!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.MarchTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="march" ng-init="c_march=tertiary_unit_march[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_march != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#marModal<% $index %>"><% tertiary_unit_march[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="marModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="march=staff_measure.staff_accomplishments[0].MarchAccomplishment">
                                                                            <div ng-if="march!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.AprilTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="april" ng-init="c_april=tertiary_unit_april[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_april != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#aprModal<% $index %>"><% tertiary_unit_april[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="aprModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="april=staff_measure.staff_accomplishments[0].AprilAccomplishment">
                                                                            <div ng-if="april!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.MayTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="may" ng-init="c_may=tertiary_unit_may[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_may != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#mayModal<% $index %>"><% tertiary_unit_may[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="mayModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="may=staff_measure.staff_accomplishments[0].MayAccomplishment">
                                                                            <div ng-if="may!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.JuneTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="june" ng-init="c_june=tertiary_unit_june[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_june != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#junModal<% $index %>"><% tertiary_unit_june[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="junModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="june=staff_measure.staff_accomplishments[0].JuneAccomplishment">
                                                                            <div ng-if="june!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.JulyTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="july" ng-init="c_july=tertiary_unit_july[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_july != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#julModal<% $index %>"><% tertiary_unit_july[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="julModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="july=staff_measure.staff_accomplishments[0].JulyAccomplishment">
                                                                            <div ng-if="july!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.AugustTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="august" ng-init="c_august=tertiary_unit_august[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_august != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#augModal<% $index %>"><% tertiary_unit_august[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="augModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="august=staff_measure.staff_accomplishments[0].AugustAccomplishment">
                                                                            <div ng-if="august!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.SeptemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="september" ng-init="c_september=tertiary_unit_september[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_september != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#sepModal<% $index %>"><% tertiary_unit_september[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="sepModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="september=staff_measure.staff_accomplishments[0].SeptemberAccomplishment">
                                                                            <div ng-if="september!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.OctoberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="october" ng-init="c_october=tertiary_unit_october[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_october != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#octModal<% $index %>"><% tertiary_unit_october[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="octModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="october=staff_measure.staff_accomplishments[0].OctoberAccomplishment">
                                                                            <div ng-if="october!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.NovemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="november" ng-init="c_november=tertiary_unit_november[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_november != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#novModal<% $index %>"><% tertiary_unit_november[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="novModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="november=staff_measure.staff_accomplishments[0].NovemberAccomplishment">
                                                                            <div ng-if="november!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% tertiary_unit_target.DecemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="december" ng-init="c_december=tertiary_unit_december[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_december != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#decModal<% $index %>"><% tertiary_unit_december[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="decModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='staff_measure in tertiary_unit_target.tertiary_unit_measure.staff_measures'>
                                                                            <input type="hidden" ng-init="december=staff_measure.staff_accomplishments[0].DecemberAccomplishment">
                                                                            <div ng-if="december!='0'">
                                                                                + <strong><% staff_measure.staff_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" name="monthlyform" value="<% tertiary_unit_target.tertiary_unit_initiative.TertiaryUnitInitiativeContent %>" ng-model="tertiary_unit_target.tertiary_unit_initiative.TertiaryUnitInitiativeContent" autocomplete="off"  required ng-touched ></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate %>" ng-model="tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" name="monthlyform" valid-number value="<% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual %>" ng-model="tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td><% tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingEstimate - tertiary_unit_target.tertiary_unit_funding.TertiaryUnitFundingActual | number: 2 %></td>

                                         <input type="hidden" name="TertiaryUnitMeasureID" value="<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" id="tertiarymeasure_id<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" />
                                         <input type="hidden" name="TertiaryUnitID" value="<?=$user->tertiary_unit->TertiaryUnitID?>" ng-model="tertiary_unit_target.TertiaryUnitID" id="tertiary_unit_id<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>" />
                                        <input type="hidden" name="UserTertiaryUnitID" value="<?=$user->UserTertiaryUnitID?>" ng-model="tertiary_unit_target.UserTertiaryUnitID" id="user_tertiary_unit_id<%tertiary_unit_target.tertiary_unit_measure.TertiaryUnitMeasureID%>">
                                        <td>
                                            
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, tertiary_unit_target.TertiaryUnitTargetID)"><span class="fa fa-save fa-fw"></span> Save Changes</button>
                                            
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