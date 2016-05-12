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
                                
                                        <td class="objective-custom-td2" colspan="4">
                                            <b>MEASURES</b>
                                        </td>


                                        <td class="objective-custom-td3" rowspan="2" >
                                            <b>OWNER</b>
                                        </td>

                                        <td class="objective-custom-td4" colspan="12">
                                            <b>TARGET/ACCUMULATION</b>
                                        </td>

                                        <td class="objective-custom-td5" rowspan="2">
                                            <b>INITIATIVES</b>
                                        </td>
                                        <td class="objective-custom-td6" colspan="3">
                                            <b>FUNDING</b>
                                        </td>
                                    </tr>

                                    <tr>
                                        
                                
                                        <td class="objective-custom-td8" colspan="2">
                                            <b>Name</b>
                                        </td>



                                        <td class="objective-custom-td9">
                                            <b>LD</b>
                                        </td>

                                        <td class="objective-custom-td10">
                                            <b>LG</b>
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
    								<tr dir-paginate='chief_target in chief_targets|filter:search|itemsPerPage:5'>
    									
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %></td>

                                                    <td style="background-color:green">
                                                
                                                    <td></td>

                                                 
                                                </td>

                                                <td style="background-color:green">
                                                </td> 

                                        <td><input type='text' id="id_owner" name="monthlyform" value="" ng-model="" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% chief_target.JanuaryTarget %>/<input type='text' id="id_jan" name="monthlyform" value="<% chief_target.JanuaryTarget %>" ng-model="chief_target.JanuaryTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.FebruaryTarget %>/<input type='text' id="id_feb" name="monthlyform" value="<% chief_target.FebruaryTarget %>" ng-model="chief_target.FebruaryTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.MarchTarget %>/<input type='text' id="id_mar" name="monthlyform" value="<% chief_target.MarchTarget %>" ng-model="chief_target.MarchTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.AprilTarget %>/<input type='text' id="id_apr" name="monthlyform" value="<% chief_target.AprilTarget %>" ng-model="chief_target.AprilTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.MayTarget %>/<input type='text' id="id_may" name="monthlyform" value="<% chief_target.MayTarget %>" ng-model="chief_target.MayTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.JuneTarget %>/<input type='text' id="id_jun" name="monthlyform" value="<% chief_target.JuneTarget %>" ng-model="chief_target.JuneTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.JulyTarget %>/<input type='text' id="id_jul" name="monthlyform" value="<% chief_target.JulyTarget %>" ng-model="chief_target.JulyTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.AugustTarget %>/<input type='text' id="id_aug" name="monthlyform" value="<% chief_target.AugustTarget %>" ng-model="chief_target.AugustTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.SeptemberTarget %>/<input type='text' id="id_sep" name="monthlyform" value="<% chief_target.SeptemberTarget %>" ng-model="chief_target.SeptemberTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.OctoberTarget %>/<input type='text' id="id_oct" name="monthlyform" value="<% chief_target.OctoberTarget %>" ng-model="chief_target.OctoberTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.NovemberTarget %>/<input type='text' id="id_nov" name="monthlyform" value="<% chief_target.NovemberTarget %>" ng-model="chief_target.NovemberTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><% chief_target.DecemberTarget %>/<input type='text' id="id_dec" name="monthlyform" value="<% chief_target.DecemberTarget %>" ng-model="chief_target.DecemberTarget" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td><input type='text' id="id_initiative" name="monthlyform" value="" ng-model="" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_estimate" name="monthlyform" value="" ng-model="" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><input type='text' id="id_actual" name="monthlyform" value="" ng-model="" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td></td>
    									
    								</tr>
    							</table>
                            </div>
							<!--./table table striped-->
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

    			</div> <!--div class col-lg-12 -->
    		</div>
    	</div>
    </div>
@endsection