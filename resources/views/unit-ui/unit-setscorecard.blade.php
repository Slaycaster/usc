@extends('layout-unit')

@section('content')

	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app-angular.js') }}"></script>

    <!-- AngularJS Controller Scripts -->
    <script src="{{ asset('app/controllers/controller_setscorecard.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
    <br>
    <div ng-app="uscApp" ng-controller="setScorecardController">
    	<div class="wrap">

    		<div class="row">
    			<div class="col-lg-5">
    				<div class="panel panel-warning">
    					<div class="panel-heading">
	    					<i class="fa fa-table fa-5x"></i> <h2><b>Set Scorecard - {{ $user->unit->UnitAbbreviation }}</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
    					</div>
    					<div class="panel-body">
    						<div class="row">
    							<div class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> 1. Choose the <b>Objective</b> from the dropdown below where you want the <b>Measures</b> be assigned to.</div>
    						</div>

    						<label for="objective_id" class="control-label">Choose Objective:</label>
    						<select name="objective_id" data-ng-model="unit_scorecard.UnitObjectiveID" class="form-control" required ng-touched>
                                <option value="0">-- Choose One --</option>
								@foreach($unit_objectives as $unit_objective)
										<option value="<?=$unit_objective->UnitObjectiveID?>">{{ $unit_objective->UnitObjectiveName }}</option>
								@endforeach
							</select>

				    		<hr>

				    		<div class="row">
				    			<div class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> 2. Now check the <b>Measures</b> from the table below you want to assign with.</div>
				    		</div>
							<table class="table table-striped table-responsive table-bordered">
								<thead>
									<td><b>Actions</b></td>
									<td><b>Measure Name</b></td>
									<td><b>Last Encoded by</b></td>
								</thead>
								<tbody>
									<tr>
										<td><input type="checkbox"/></td>
										<td># of CPSM Facebook likes</td>
										<td>PSINSP Ador de Leon</td>
									</tr>
									<tr>
										<td><input type="checkbox"/></td>
										<td># of Document of CPSM activities (Internal and External) through photo and video coverage</td>
										<td>CIV Arman Awatin</td>
									</tr>
									<tr>
										<td><input type="checkbox"/></td>
										<td>No. of Electronic Community Engagement Survey (e-CES) assistance provided</td>
										<td>PCINSP Ma. Angela Salaya</td>
									</tr>
									<tr>
										<td><input type="checkbox"/></td>
										<td># of days supervising Chief, PBAS in ensuring the successful planning, implementation and evaluation of the Strategic Focus Enhancement Program (SFEP)</td>
										<td>PSUPT Ercy Nanette Tomas</td>
									</tr>
								</tbody>
							</table>
    						
							<button type="button" class="btn btn-primary btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEditObjective.$invalid">Save</button>

    					</div>
    				</div>
    			</div>

    			<div class="col-lg-7">
    				<div class="panel panel-default">
    					<div class="panel-heading">
    						<i class="fa fa-edit fa-5x"></i> <h2><b>Scorecard Preview</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
    					</div>
    					<div class="panel-body">
    						<div class="row">
    							<div class="alert alert-info"><i class="fa fa-info-circle fa-fw"></i> This is how the {{ $user->unit->UnitAbbreviation }} scorecard looks like.</div>
    						</div>

    						<table class="table table-striped table-responsive table-bordered">
    							<thead>
    								<td></td>
    								<td><b>Perspective</b></td>
    								<td><b>Objective</b></td>
    								<td><b>Measure</b></td>
    								<td><b>LD</b></td>
    								<td><b>LG</b></td>
    							</thead>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td>Process Excellence</td>
    								<td>Ensure organizational alignment</td>
    								<td>Supervise Chief, ITAS in providing technical assistance to CPSM activities</td>
    								<td></td>
    								<td></td>
    							</tr>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td></td>
    								<td></td>
    								<td># of days supervising Chief, PBAS in ensuring, monitoring and evaluating all compliances pertinent to the functionality of the TWG for PNP P.A.T.R.O.L Plan 2030</td>
    								<td></td>
    								<td></td>
    							</tr>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td></td>
    								<td></td>
    								<td>Administration and maintenance of CPSM Website</td>
    								<td></td>
    								<td></td>
    							</tr>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td></td>
    								<td></td>
    								<td>Supervise Chief, ITAS in the maintenance of Information System, ICT Infrastructure, CPSM Website and Social Media Accounts</td>
    								<td></td>
    								<td></td>
    							</tr>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td></td>
    								<td>Ensure functional PNP Scorecard</td>
    								<td>Provide support and maintenance to e-Learning Systems (BEL, ELA, and ELACs)</td>
    								<td></td>
    								<td></td>
    							</tr>
    							<tr>
    								<td><button class="btn btn-warning btn-xs" ng-click="deleteUnitObjective($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
    								<td></td>
    								<td></td>
    								<td>Administration, support and maintenance of CPSM E-mail System</td>
    								<td></td>
    								<td></td>
    							</tr>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>

    </div>

@endsection