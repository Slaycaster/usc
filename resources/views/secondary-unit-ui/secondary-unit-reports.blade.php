@extends('layout-secondary')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/secondary_unit_objectives.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <br>
	<div ng-app="unitScorecardApp" ng-controller="APISecondaryUnitObjectiveController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning objectives-custom-panel">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $user->secondary_unit->SecondaryUnitAbbreviation }} Objectives</b>
                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
                        <div class="panel-body">
                            <!--/.div class row-->
                            <div class="row">
                                <div ng-show="info" class="alert alert-info">
                                    <i class="fa fa-info-circle fa-fw"></i>Scorecard Reports of {{ $user->secondary_unit->SecondaryUnitName }}.
                                </div>
                            </div>
                            <!--./div class row-->
                            <div class="col-md-5">
                                <div>
                                    <form method="get" action="{{ url('report/yearlySecondaryUnitScorecard') }}" target="_blank">
                                        <div>
                                            <label for="year" class="control">Yearly Scorecard Report:</label>
                                            <br>
                                            <select id="year" name="year" class="form-control" style="text-align-last: center;font-size: 16px;">
                                                @foreach($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <button type="submit" class="btn btn-success btn-sm btn-block" id="btn-save">Generate PDF</button>
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