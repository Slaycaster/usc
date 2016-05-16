@extends('layout-unit')
@section('content')

 	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_scorecard.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIUnitScorecardController">
    	<div id="wrap">
    		<div class="row">
    			<div class="col-lg-12 col-md-12 col-xs-12">
    				<div class="panel panel-info">
    					<div class="panel-heading measures-custom-heading">
						  <img class="img-responsive unitdashboard-custom-unitpic" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
						  <h2 class="heading"><b>{{ $user->unit->UnitAbbreviation }} Scorecard for {{ date("Y") }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
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
    								<tr dir-paginate='unit_target in unit_targets|filter:search|itemsPerPage:5'>
    									
                                        <td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %></td>

                                        <td colspan="2"><% unit_target.unit_measure.UnitMeasureName %></td>


                                        <td><b><% unit_target.unit_measure.UnitMeasureType %></b></td>
                                        

                                        <td><textarea rows="5" id="id_owner" name="monthlyform" value="<% unit_target.unit_measure.unit_owners.UnitOwnerContent %>" ng-model="unit_owner.UnitOwnerContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><% unit_target.JanuaryTarget | number: 2 %>/<input type='text' id="id_jan" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.JanuaryAccomplishment  %>" ng-model="unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.FebruaryTarget | number: 2 %>/<input type='text' id="id_feb" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.FebruaryAccomplishment %>" ng-model="unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.MarchTarget | number: 2 %>/<input type='text' id="id_mar" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.MarchAccomplishment %>" ng-model="unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.AprilTarget | number: 2 %>/<input type='text' id="id_apr" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.AprilAccomplishment %>" ng-model="unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.MayTarget | number: 2 %>/<input type='text' id="id_may" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.MayAccomplishment %>" ng-model="unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.JuneTarget | number: 2 %>/<input type='text' id="id_jun" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.JuneAccomplishment %>" ng-model="unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.JulyTarget | number: 2 %>/<input type='text' id="id_jul" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.JulyAccomplishment %>" ng-model="unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.AugustTarget | number: 2 %>/<input type='text' id="id_aug" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.AugustAccomplishment %>" ng-model="unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.SeptemberTarget | number: 2 %>/<input type='text' id="id_sep" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.SeptemberAccomplishment %>" ng-model="unit_accomplishment.SeptemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.OctoberTarget | number: 2 %>/<input type='text' id="id_oct" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.OctoberAccomplishment %>" ng-model="unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.NovemberTarget | number: 2 %>/<input type='text' id="id_nov" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.NovemberAccomplishment %>" ng-model="unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><% unit_target.DecemberTarget | number: 2 %>/<input type='text' id="id_dec" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_accomplishments.DecemberAccomplishment %>" ng-model="unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><textarea rows="5" id="id_initiative" name="monthlyform" value="<% unit_target.unit_measure.unit_initiatives.UnitInitiativeContent %>" ng-model="staff_initiative.staffInitiativeContent" autocomplete="off"  required ng-touched /></textarea></td>

                                        <td><input type='number' id="id_estimate" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_fundings.UnitFundingEstimate %>" ng-model="unit_funding.UnitFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td><input type='number' id="id_actual" name="monthlyform" valid-number value="<% unit_target.unit_measure.unit_fundings.UnitFundingActual %>" ng-model="unit_funding.UnitFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        <td></td>
                                         <input type="hidden" name="UnitMeasureID" value="<%unit_target.unit_measure.UnitMeasureID%>" id="unitmeasure_id">
    									 <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id">
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id">
    								</tr>
    							</table>

                            </div>
                            <!--./table table striped-->
                            <br>
                                 <button type="button" class="btn btn-success" style='text-align:left; font-size:15px; padding-top:10px; padding-bottom:10px; margin-left:85%;' id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditMeasure.$invalid">Save Changes</button>
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