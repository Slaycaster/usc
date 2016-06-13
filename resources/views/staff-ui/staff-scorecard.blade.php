@extends('layout-staff')
@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- <script src="{{ asset('js/stickyheader.js') }}"></script> -->

    <script src="{{ asset('js/debounce.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stickyheader.css') }}">
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_scorecard.js') }}"></script>

    <script src="{{ asset('js/floatingscrollbar.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIStaffScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
                          
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $staff_user->staff->StaffAbbreviation }} Scorecard for {{ date("Y") }}</b>
                                <div class="col-md-5 pull-right">
                                    <form method="get" id="tableinfo" action="{{ url('report/currentYearStaffScorecard') }}" target="_blank">
                                        <button type="submit" class="btn btn-warning btn-sm pull-right" name="total" value="total"><i class="fa fa-save fa-fw"></i>Generate Report (Total)</button>
                                        <button type="submit" class="btn btn-warning btn-sm pull-right" name="breakdown" value="breakdown"><i class="fa fa-save fa-fw"></i>Generate Report (Breakdown)</button>
                                    </form>
                                </div>
                            </h2>  
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            <div class="custom_scorecard-info" id="tableinfo">
                                <i><span class="fa fa-list fa-fw"></span> Accomplishment last updated by: <b><% updatedby.user_staff.rank.RankCode %> <% updatedby.user_staff.UserStaffLastName %>, <% updatedby.user_staff.UserStaffFirstName %> on 
                                    <% updatedby.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i><span class="fa fa-user fa-fw"></span> Owner last updated by: <b><% updatedby2.user_staff.rank.RankCode %> <% updatedby2.user_staff.UserStaffLastName %>, <% updatedby2.user_staff.UserStaffFirstName %> on 
                                    <% updatedby2.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br>
                                <i><span class="fa fa-sitemap fa-fw"></span> Initiative last updated by: <b><% updatedby3.user_staff.rank.RankCode %> <% updatedby3.user_staff.UserStaffLastName %>, <% updatedby3.user_staff.UserStaffFirstName %> on 
                                    <% updatedby3.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i><br> 
                                <i><span class="fa fa-money fa-fw"></span> Funding last updated by: <b><% updatedby4.user_staff.rank.RankCode %> <% updatedby4.user_staff.UserStaffLastName %>, <% updatedby4.user_staff.UserStaffFirstName %> on 
                                    <% updatedby4.updated_at | date:"MMM d, y 'at' h:mm:ss a" %> </b></i>  
                                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div><!--div panel-heading-->

                        <div class="panel-body">

                            <div ng-show="info" class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i>To see the contributory breakdown of the measure's accomplishment, just click at the number around grey box.</div>
                           

                            <div class="table-responsive tabledata" id="floating-scrollbar">

                                <table class="table table-bordered" id="tabledata">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" >
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
                                    <tbody>
                                    <tr ng-repeat='staff_target in staff_targets'>
                                        
                                        <td><% staff_target.staff_measure.staff_objective.StaffObjectiveName %>
                                        </td>

                                        <input type="hidden" value="<% staff_target.staff_measure.ChiefMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% staff_target.staff_measure.StaffMeasureName %>
                                            <span class="label label-primary" ng-if="c_measure=staff_target.staff_measure.ChiefMeasureID">Contributory to C, PNP</span><br /><i style="font-size:10px;">Contributory/ies to this Measure</i>
                                            <!--Contributory Accomplishment--><br /><p style="display: inline" ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'><span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </p>
                                            
                                        </td>

                                        <input type="hidden" ng-model="stafftype" ng-init="c_type=staff_target.staff_measure.StaffMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>


                                        <td><center><textarea rows="5" cols="27" id="id_owner<%staff_target.StaffTargetID%>" name="monthlyform" value="<% staff_target.staff_owner.StaffOwnerContent %>" ng-model="staff_target.staff_owner.StaffOwnerContent" autocomplete="off" ng-touched ng-change="ownerchange()"/></textarea></center></td>

     
                                        <td><% staff_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month"  id="id_jan<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JanuaryAccomplishment  %>" ng-model="staff_target.staff_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                            <input type="hidden" ng-model="january" ng-init="s_january=staff_january[$index]">
                                            <!--Contributory Accomplishment-->
                                            <div style="margin-top: 5%" ng-if="s_january != '0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#janModal<% $index %>"><% staff_january[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="january=unit_measure.unit_accomplishments[0].JanuaryAccomplishment">
                                                                            <div ng-if="january!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </td>

                                        <td><% staff_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.FebruaryAccomplishment %>" ng-model="staff_target.staff_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                            <!--Contributory Accomplishment-->
                                           

                                            <input type="hidden" ng-model="february" ng-init="s_february=staff_february[$index]">
                                            <div style="margin-top: 5%" ng-if="s_february!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#febModal<% $index %>"><% staff_february[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="february=unit_measure.unit_accomplishments[0].FebruaryAccomplishment">
                                                                            <div ng-if="february!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MarchAccomplishment %>" ng-model="staff_target.staff_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                             
                                            <input type="hidden" ng-model="march" ng-init="s_march=staff_march[$index]">
                                            <div style="margin-top: 5%" ng-if="s_march!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#marModal<% $index %>"><% staff_march[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="march=unit_measure.unit_accomplishments[0].MarchAccomplishment">
                                                                            <div ng-if="march!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AprilAccomplishment %>" ng-model="staff_target.staff_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                        
                                            <input type="hidden" ng-model="april" ng-init="s_april=staff_april[$index]">
                                            <div style="margin-top: 5%" ng-if="s_april!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#aprModal<% $index %>"><% staff_april[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="april=unit_measure.unit_accomplishments[0].AprilAccomplishment">
                                                                            <div ng-if="april!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MayAccomplishment %>" ng-model="staff_target.staff_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="may" ng-init="s_may=staff_may[$index]">
                                            <div style="margin-top: 5%" ng-if="s_may!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#mayModal<% $index %>"><% staff_may[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="may=unit_measure.unit_accomplishments[0].MayAccomplishment">
                                                                            <div ng-if="may!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                  + <strong><% unit_measure.unit_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JuneAccomplishment %>" ng-model="staff_target.staff_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="june" ng-init="s_june=staff_june[$index]">
                                            <div style="margin-top: 5%" ng-if="s_june!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#juneModal<% $index %>"><% staff_june[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="juneModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="june=unit_measure.unit_accomplishments[0].JuneAccomplishment">
                                                                            <div ng-if="june!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                        <td><% staff_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JulyAccomplishment %>" ng-model="staff_target.staff_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="july" ng-init="s_july=staff_july[$index]">
                                            <div style="margin-top: 5%" ng-if="s_july!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#julyModal<% $index %>"><% staff_july[$index] %></button>
                                            </div>

                                              <div class="modal fade" id="julyModal<% $index %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <i class="fa fa-group fa-4x"></i>
                                                                <h4 class="modal-title" id="myModalLabel"><b>THE CONTRIBUTORY</b></h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <form name="frmEditTarget" class="form-horizontal" novalidate="">
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="july=unit_measure.unit_accomplishments[0].JulyAccomplishment">
                                                                            <div ng-if="july!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                        <td><% staff_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AugustAccomplishment %>" ng-model="staff_target.staff_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="august" ng-init="s_august=staff_august[$index]">
                                            <div style="margin-top: 5%" ng-if="s_august!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#augModal<% $index %>"><% staff_august[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="august=unit_measure.unit_accomplishments[0].AugustAccomplishment">
                                                                            <div ng-if="august!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.SeptemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="september" ng-init="s_september=staff_september[$index]">
                                            <div style="margin-top: 5%" ng-if="s_september!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#sepModal<% $index %>"><% staff_september[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="september=unit_measure.unit_accomplishments[0].SeptemberAccomplishment">
                                                                            <div ng-if="september!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                        <td><% staff_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.OctoberAccomplishment %>" ng-model="staff_target.staff_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                            <input type="hidden" ng-model="october" ng-init="s_october=staff_october[$index]">
                                            <div style="margin-top: 5%" ng-if="s_october!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#octModal<% $index %>"><% staff_october[$index] %></button>


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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="october=unit_measure.unit_accomplishments[0].OctoberAccomplishment">
                                                                            <div ng-if="october!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.NovemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                             
                                            <input type="hidden" ng-model="november" ng-init="s_november=staff_november[$index]">
                                            <div style="margin-top: 5%" ng-if="s_september!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#novModal<% $index %>"><% staff_november[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="november=unit_measure.unit_accomplishments[0].NovemberAccomplishment">
                                                                            <div ng-if="november!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><% staff_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.DecemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched ng-change="accompchange()"/>

                                             <!--Contributory Accomplishment-->
                                           
                                            <input type="hidden" ng-model="december" ng-init="s_december=staff_december[$index]">
                                            <div style="margin-top: 5%" ng-if="s_december!='0'">
                                                + 
                                                
                                                <button id="jan" data-toggle="modal" class="btn btn-xs" style="background-color: rgba(36,36,36,.5); color: white; " href="#decModal<% $index %>"><% staff_december[$index] %></button>
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
                                                                        <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                                            <input type="hidden" ng-init="december=unit_measure.unit_accomplishments[0].DecemberAccomplishment">
                                                                            <div ng-if="december!='0'">
                                                                                <div ng-if="unit_measure.unit_accomplishments[0] != null">
                                                                                    + <strong><% unit_measure.unit_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </td>

                                        <td><center><textarea rows="5" cols="27" id="id_initiative<%staff_target.StaffTargetID%>" name="monthlyform" value="<% staff_target.staff_initiative.StaffInitiativeContent %>" ng-model="staff_target.staff_initiative.StaffInitiativeContent" autocomplete="off" ng-touched ng-change="initchange()"/></textarea></center></td>

                                        <td><input type='text' id="id_estimate<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingEstimate %>" ng-model="staff_target.staff_funding.StaffFundingEstimate" autocomplete="off" class="form-control" ng-touched ng-change="fundingchange()"/></td>
                                        <td ><input type='text' id="id_actual<%staff_target.StaffTargetID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingActual %>" ng-model="staff_target.staff_funding.StaffFundingActual" autocomplete="off" class="form-control" ng-touched ng-change="fundingchange()"/></td>

                                        <td><% staff_target.staff_funding.StaffFundingEstimate - staff_target.staff_funding.StaffFundingActual | number: 2 %></td>

                                         <input type="hidden" name="StaffMeasureID" value="<%staff_target.staff_measure.StaffMeasureID%>" id="staffmeasure_id<%staff_target.StaffTargetID%>">
                                         <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id<%staff_target.StaffTargetID%>">
                                        <input type="hidden" name="UserStaffID" value="<?=$staff_user->UserStaffID?>" id="user_staff_id<%staff_target.StaffTargetID%>">
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, staff_target.StaffTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
                                         </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                            <!--./table table striped-->
                            <br>
                                
                           
                        <!-- div panel-body-->
                </div><!--div panel panel-info-->
            </div>
        </div>
    </div>
     <script type="text/javascript">
        $(document).ready(function () {
            $("#floating-scrollbar").floatingScrollbar();
        });

    </script>

<script>
// Get the modal
var modal = document.getElementById('janModal');

// Get the button that opens the modal
var btn = document.getElementById("jan");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script src="{{ asset('js/showtabledata.js') }}"></script>

@endsection