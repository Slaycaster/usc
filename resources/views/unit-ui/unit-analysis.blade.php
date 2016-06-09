@extends('layout-unit')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_targets.js') }}"></script>


    <div ng-app="unitScorecardApp" ng-controller="APIUnitTargetController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning targets-custom-panel">
						<div class="panel-heading measures-custom-heading">
						    <i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $user->unit->UnitAbbreviation }} Scorecard Analysis Report</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<!--/.div class row-->
							<div class="row">
                                <div ng-show="info" class="alert alert-info objective-info-name">
                                    <i class="fa fa-info-circle fa-fw"></i>Scorecard Analysis Reports of {{ $user->unit->UnitName }}.
                                </div>
                                <div ng-show="info" class="alert alert-info objective-info-abb">
                                    <i class="fa fa-info-circle fa-fw"></i>Scorecard Analysis Reports of {{ $user->unit->UnitAbbreviation }}.
                                </div>
                            </div>
							<!--./div class row-->
                            <div class="col-md-4 col-lg-4">
                                <div>
                                    <form method="get" action="{{ url('report/quarterlyUnitAnalysis') }}" target="_blank">
                                        <div>
                                            <label for="year" class="control">Quarterly Scorecard KPI Report:</label>
                                            <br>
                                            <div class="col-md-5 col-lg-5 col-xs-5">
                                                <select id="quarter" name="quarter" class="form-control" style="text-align-last: center;font-size: 16px;">
                                                    <option value="1">Q1</option>
                                                    <option value="2">Q2</option>
                                                    <option value="3">Q3</option>
                                                    <option value="4">Q4</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7 col-lg-7 col-xs-7">
                                                <select id="year" name="year" class="form-control" style="text-align-last: center;font-size: 16px;">
                                                    @foreach($years as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-12 col-lg-12 col-xs-12">
                                                <button type="submit" class="btn btn-success btn-sm btn-block" id="btn-save">Generate PDF</button>
                                            </div>
                                            <br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div>
                                    <form method="get" action="{{ url('report/yearlyUnitAnalysisBarGraph') }}" target="_blank">
                                        <div>
                                            <label for="year" class="control">Yearly Scorecard Analysis Report in Bar Graph:</label>
                                            <br>
                                            <div class="col-md-12 col-xs-12">
                                                <select id="year" name="year" class="form-control" style="text-align-last: center;font-size: 16px;">
                                                    @foreach($years as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-12 col-xs-12">
                                                <button type="submit" class="btn btn-success btn-sm btn-block" id="btn-save">Generate PDF</button>
                                            </div>
                                            <br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>      
        </div>
    </div>
@endsection