@extends('layout-staff')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_targets.js') }}"></script>

    <div ng-app="unitScorecardApp" ng-controller="APIStaffTargetController">
        <div class="wrap">
            <div class="row">           
                <div class="col-lg-12">
                    <div class="panel panel-warning targets-custom-panel">
                        <div class="panel-heading measures-custom-heading">
                            <i class="fa fa-circle-o-notch fa-5x"></i> 
                            <h2>
                                <b>{{ $staff->StaffAbbreviation }} Scorecard Report</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="panel-body">
                            <!--/.div class row-->
                            <div class="row">
                                <div ng-show="info" class="alert alert-info">
                                    <i class="fa fa-info-circle fa-fw"></i>Scorecard Reports of {{ $staff_user->staff->StaffName }}.
                                </div>
                            </div>
                            <!--./div class row-->
                            <div class="col-md-5">
                                <div>
                                    <form method="get" action="{{ url('report/yearlyStaffScorecard') }}" target="_blank">
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