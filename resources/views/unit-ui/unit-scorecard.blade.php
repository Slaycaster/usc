@extends('layout-unit')

@section('content')

	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app-angular.js') }}"></script>

    <!-- AngularJS Controller Scripts -->
    <script src="{{ asset('app/controllers/controller_scorecard.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

  	<!-- Floating Scrollbar Scripts -->
    <script src="{{ asset('app/floating_scrollbar.js') }}"></script>

    <script type="text/javascript">
    	$(document).ready(function () {
		    $(".panel-body").floatingScrollbar();
		});
    </script>



    <div ng-app="uscApp" ng-controller="scorecardController">
    	<div class="wrap">
    		<div class="row">
    			<div class="col-lg-12">
    				<div class="panel panel-info">
    					<div class="panel-heading">
    						<div class="panel-heading">
		    					<img style="height:200px;" class="img-responsive" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
		    					<h2><b>{{$user->unit->UnitAbbreviation}} Scorecard</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
		    					<div class="pull-right">
		    						<a href="#" class="btn btn-warning btn-sm"><i class="fa fa-table fa-fw"></i> Update Accomplishments</a>
		    					</div>
		    					<h5><i>Last updated by: <b>PSINSP Ador de Leon</b> at <b>03/17/2016 - 5:31PM</b></i></h5>
	    					</div>
    					</div>
    					<div class="panel-body table-responsive">
    						<table class="table table-responsive table-bordered">
    							<thead>
    								<tr>
	    								
	    								<td><b>Perspective</b></td>
	    								<td><b>Objective</b></td>
	    								<td><b>Measure</b></td>
	    								<td><b>LD</b></td>
	    								<td><b>LG</b></td>
	    								<td><b>Owner</b></td>
	    								<td><b>Baseline</b></td>
	    								<td><b>Target - for Period</b></td>
	    								<td colspan="6"><b><center>Accomplishments</center></b></td>
	    								<td><b>Total</b></td>
	    								<td><b>Variance</b></td>
	    								<td colspan="3"><b><center>Funding</center></b></td>
    								</tr>
    								<tr>
    									
    									<td></td>
    									<td></td>
    									<td></td>
    									<td></td>
    									<td></td>
    									<td></td>
    									<td></td>
    									<td></td>
    									<td><center><b>2016</b></center></td>
    									<td><center><b>2017</b></center></td>
    									<td><center><b>2018</b></center></td>
    									<td><center><b>2019</b></center></td>
    									<td><center><b>2020</b></center></td>
    									<td><center><b>2021</b></center></td>
    									<td></td>
    									<td></td>
    									<td><center><b>Actual</b></center></td>
    									<td><center><b>Available</b></center></td>
    									<td><center><b>Variance</b></center></td>
    								</tr>
    							</thead>
    							<tr>
    								
    								<td>Process Excellence</td>
    								<td>Ensure organizational alignment</td>
    								<td>Supervise Chief, ITAS in providing technical assistance to CPSM activities</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    							<tr>
    								
    								<td></td>
    								<td></td>
    								<td># of days supervising Chief, PBAS in ensuring, monitoring and evaluating all compliances pertinent to the functionality of the TWG for PNP P.A.T.R.O.L Plan 2030</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    							<tr>
    								
    								<td></td>
    								<td></td>
    								<td>Administration and maintenance of CPSM Website</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    							<tr>
    								
    								<td></td>
    								<td></td>
    								<td>Supervise Chief, ITAS in the maintenance of Information System, ICT Infrastructure, CPSM Website and Social Media Accounts</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    							<tr>
    								
    								<td></td>
    								<td>Ensure functional PNP Scorecard</td>
    								<td>Provide support and maintenance to e-Learning Systems (BEL, ELA, and ELACs)</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    							<tr>
    								
    								<td></td>
    								<td></td>
    								<td>Administration, support and maintenance of CPSM E-mail System</td>
    								<td></td>
    								<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td><input type="number" class="form-control" value="0"/></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
    							</tr>
    						</table>
    					</div>
    					<div class="panel-footer">
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

@endsection