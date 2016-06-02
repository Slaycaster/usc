@extends('layout-chief')
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
    <script src="{{ asset('app/controllers/chief_scorecard.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIChiefScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                            <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
                          
                            <h2 class="heading">
                                <b>{{ $chief_user->chief->ChiefAbbreviation }} Scorecard for {{ date("Y") }}
                                </b>
                                <div class="col-md-5 pull-right">
                                    <form method="get" action="{{ url('report/currentYearChiefScorecard') }}" target="_blank">
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
                                    <tr ng-repeat='chief_target in chief_targets|filter:search'>
                                        
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %><br /><i style="font-size:10px;">Contributory/ies to this Measure</i><!--Contributory Accomplishment--><br /><p style="display: inline" class="scorecard-minilabel" ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                            <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>
                                        </td>


                                        <input type="hidden" ng-model="chieftype" ng-init="c_type=chief_target.chief_measure.ChiefMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>
                                        

                                        <td><center>
                                            <textarea rows="5" cols="27" id="id_owner<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform"  value="<% chief_target.chief_owner.ChiefOwnerContent %>" ng-model="chief_target.chief_owner.ChiefOwnerContent" autocomplete="off"  required ng-touched></textarea>
                                            </center>
                                        </td>

                                        <td><% chief_target.JanuaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                           <input type="hidden" ng-model="january" ng-init="c_january=chief_january[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_january != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#janModal<% $index %>"><% chief_january[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                        </td>

                                        <td><% chief_target.FebruaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="february" ng-init="c_february=chief_february[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_february != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#febModal<% $index %>"><% chief_february[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.MarchTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="march" ng-init="c_march=chief_march[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_march != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#marModal<% $index %>"><% chief_march[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.AprilTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="april" ng-init="c_april=chief_april[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_april != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#aprModal<% $index %>"><% chief_april[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.MayTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="may" ng-init="c_may=chief_may[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_may != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#mayModal<% $index %>"><% chief_may[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.JuneTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="june" ng-init="c_june=chief_june[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_june != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#junModal<% $index %>"><% chief_june[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.JulyTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="july" ng-init="c_july=chief_july[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_july != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#julModal<% $index %>"><% chief_july[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.AugustTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="august" ng-init="c_august=chief_august[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_august != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#augModal<% $index %>"><% chief_august[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.SeptemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="september" ng-init="c_september=chief_september[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_september != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#sepModal<% $index %>"><% chief_september[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.OctoberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="october" ng-init="c_october=chief_october[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_october != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#octModal<% $index %>"><% chief_october[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.NovemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="november" ng-init="c_november=chief_november[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_november != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#novModal<% $index %>"><% chief_november[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% chief_target.DecemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="december" ng-init="c_december=chief_december[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="c_december != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#decModal<% $index %>"><% chief_december[$index] %></button>
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
                                                                        <div ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                                            + <strong><% staff_measure.staff_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" value="<% chief_target.chief_initiative.ChiefInitiativeContent %>" ng-model="chief_target.chief_initiative.ChiefInitiativeContent" autocomplete="off"  required ng-touched ></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingEstimate %>" ng-model="chief_target.chief_funding.ChiefFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingActual %>" ng-model="chief_target.chief_funding.ChiefFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td><% chief_target.chief_funding.ChiefFundingEstimate - chief_target.chief_funding.ChiefFundingActual | number: 2 %></td>

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