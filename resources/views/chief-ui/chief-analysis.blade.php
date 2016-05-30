@extends('layout-chief')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/chief_targets.js') }}"></script>

    <script src="{{ asset('bower_components/ng-decimal/ng-decimal.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIChiefTargetController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning  targets-custom-panel">
						<div class="panel-heading measures-custom-heading">
                            <i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $chief->ChiefAbbreviation }} Scorecard Analysis Report</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
                                <div ng-show="info" class="alert alert-info">
                                    <i class="fa fa-info-circle fa-fw"></i>Scorecard Analysis Reports of {{ $chief_user->chief->ChiefName }}.
                                </div>
                            </div>
							<!--./div class row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection