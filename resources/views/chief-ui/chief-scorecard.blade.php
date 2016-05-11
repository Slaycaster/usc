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

    <div ng-app="unitScorecardApp" ng-controller="ChiefScorecardController">
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
    									<td class="objective-custom-td1">
                                            <b>Objective</b>
    									</td>
    							
    									<td class="objective-custom-td2">
                                            <b>Measure</b>
    									</td>


                                        <td class="objective-custom-td3">
                                            <b>Formula</b>
                                        </td>

                                        <td class="objective-custom-td4">
                                            <b>Target Period</b>
                                        </td>

    									</td>
    									<td class="objective-custom-td5">
                                            <b>Action</b>
    									</td>
    									<td class="objective-custom-td6">
                                            <b>Effectivity Date</b>
    									</td>
    									
    								</thead>
    								<tr dir-paginate='chief_target in chief_targets|orderBy:"updated_at":true:sortKey:reverse|filter:search|itemsPerPage:5'>
    									<td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>
    									<td><% chief_target.chief_measure.ChiefMeasureName %></td>
                                        <td><% chief_target.chief_measure.ChiefMeasureFormula %></td>
                                        <td><% chief_target.TargetPeriod %></td>
    									<td>
    										<button id="btn-add" class="btn btn-info btn-block btn-md" ng-click="toggle('view', chief_target.ChiefTargetID, chief_target.chief_measure.ChiefMeasureName )">View Target</button>
    										<br>
    										<button id="btn-add" class="btn btn-warning btn-block btn-md" ng-click="toggle('show', chief_target.ChiefTargetID, chief_target.chief_measure.ChiefMeasureName)">Set Target</button>

    									</td>
    									<td><% chief_target.TargetDate %></td>
    									
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