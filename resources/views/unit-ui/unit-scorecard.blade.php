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
                          
                            <h2 class="heading">
                                <b>{{ $user->unit->UnitAbbreviation }} Scorecard for {{ date("Y") }}
                                </b>
                                <div class="col-md-5 pull-right">
                                    <form method="get" action="{{ url('report/currentYearUnitScorecard') }}" target="_blank">
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
                                    <tr ng-repeat='unit_target in unit_targets|filter:search'>
                                        
                                        <td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %></td>

                                        <td colspan="2"><% unit_target.unit_measure.UnitMeasureName %><br /><i style="font-size:10px;">Contributory/ies to this Measure</i><!--Contributory Accomplishment--><br /><p style="display: inline" class="scorecard-minilabel" ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                            <span class="label label-info"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                            </p>
                                        </td>


                                        <input type="hidden" ng-model="unittype" ng-init="u_type=unit_target.unit_measure.UnitMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="u_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="u_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="u_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="u_type=='LD'"></td>
                                        

                                        <td><center>
                                            <textarea rows="5" cols="27" id="id_owner<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform"  value="<% unit_target.unit_owner.UnitOwnerContent %>" ng-model="unit_target.unit_owner.UnitOwnerContent" autocomplete="off"  required ng-touched></textarea>
                                            </center>
                                        </td>

                                        <td><% unit_target.JanuaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                           <input type="hidden" ng-model="january" ng-init="u_january=unit_january[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_january != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#janModal<% $index %>"><% unit_january[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="january=secondary_unit_measure.secondary_unit_accomplishments[0].JanuaryAccomplishment">
                                                                            <div ng-if="january!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                        </td>

                                        <td><% unit_target.FebruaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="february" ng-init="u_february=unit_february[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_february != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#febModal<% $index %>"><% unit_february[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="february=secondary_unit_measure.secondary_unit_accomplishments[0].FebruaryAccomplishment">
                                                                            <div ng-if="february!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.MarchTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="march" ng-init="u_march=unit_march[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_march != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#marModal<% $index %>"><% unit_march[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="march=secondary_unit_measure.secondary_unit_accomplishments[0].MarchAccomplishment">
                                                                            <div ng-if="march!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.AprilTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="april" ng-init="u_april=unit_april[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_april != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#aprModal<% $index %>"><% unit_april[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="april=secondary_unit_measure.secondary_unit_accomplishments[0].AprilAccomplishment">
                                                                            <div ng-if="april!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.MayTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="may" ng-init="u_may=unit_may[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_may != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#mayModal<% $index %>"><% unit_may[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="may=secondary_unit_measure.secondary_unit_accomplishments[0].MayAccomplishment">
                                                                            <div ng-if="may!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.JuneTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="june" ng-init="u_june=unit_june[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_june != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#junModal<% $index %>"><% unit_june[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="june=secondary_unit_measure.secondary_unit_accomplishments[0].JuneAccomplishment">
                                                                            <div ng-if="june!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.JulyTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="july" ng-init="u_july=unit_july[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_july != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#julModal<% $index %>"><% unit_july[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="july=secondary_unit_measure.secondary_unit_accomplishments[0].JulyAccomplishment">
                                                                            <div ng-if="july!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.AugustTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="august" ng-init="u_august=unit_august[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_august != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#augModal<% $index %>"><% unit_august[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="august=secondary_unit_measure.secondary_unit_accomplishments[0].AugustAccomplishment">
                                                                            <div ng-if="august!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.SeptemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="september" ng-init="u_september=unit_september[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_september != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#sepModal<% $index %>"><% unit_september[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="september=secondary_unit_measure.secondary_unit_accomplishments[0].SeptemberAccomplishment">
                                                                            <div ng-if="september!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.OctoberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="october" ng-init="u_october=unit_october[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_october != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#octModal<% $index %>"><% unit_october[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="october=secondary_unit_measure.secondary_unit_accomplishments[0].OctoberAccomplishment">
                                                                            <div ng-if="october!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.NovemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="november" ng-init="u_november=unit_november[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_november != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#novModal<% $index %>"><% unit_november[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="november=secondary_unit_measure.secondary_unit_accomplishments[0].NovemberAccomplishment">
                                                                            <div ng-if="november!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% unit_target.DecemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="december" ng-init="u_december=unit_december[$index] | number: 2">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="u_december != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#decModal<% $index %>"><% unit_december[$index] %></button>
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
                                                                        <div ng-repeat='secondary_unit_measure in unit_target.unit_measure.secondary_unit_measures'>
                                                                            <input type="hidden" ng-init="december=secondary_unit_measure.secondary_unit_accomplishments[0].DecemberAccomplishment">
                                                                            <div ng-if="december!='0'">
                                                                                + <strong><% secondary_unit_measure.secondary_unit_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% secondary_unit_measure.secondary_unit_accomplishments[0].secondary_unit.SecondaryUnitAbbreviation %></span>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_initiative.UnitInitiativeContent %>" ng-model="unit_target.unit_initiative.UnitInitiativeContent" autocomplete="off"  required ng-touched ></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingEstimate %>" ng-model="unit_target.unit_funding.UnitFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingActual %>" ng-model="unit_target.unit_funding.UnitFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td><% unit_target.unit_funding.UnitFundingEstimate - unit_target.unit_funding.UnitFundingActual | number: 2 %></td>

                                         <input type="hidden" name="UnitMeasureID" value="<%unit_target.unit_measure.UnitMeasureID%>" id="unitmeasure_id<%unit_target.unit_measure.UnitMeasureID%>" />
                                         <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" ng-model="unit_target.UnitID" id="unit_id<%unit_target.unit_measure.UnitMeasureID%>" />
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" ng-model="unit_target.UserUnitID" id="user_unit_id<%unit_target.unit_measure.UnitMeasureID%>">
                                        <td>
                                            
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, unit_target.UnitTargetID)"><span class="fa fa-save fa-fw"></span> Save Changes</button>
                                            
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