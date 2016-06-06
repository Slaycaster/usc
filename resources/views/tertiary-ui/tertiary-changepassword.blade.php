@extends('layout-tertiary-unit')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/tertiary_unit_measures.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APITertiaryUnitMeasureController">
       <form action="{{url('change_password')}}" method="post">
            <div class="wrap">
                <div class="row">           
                    <div class="col-lg-12">
                        <div class="panel panel-warning measures-custom-panel">
                            <div class="panel-heading measures-custom-heading">
                                <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->tertiary_unit->TertiaryUnitAbbreviation }} Change Password</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="panel-body">
                                <!--/.div class row-->
                                <div class="row">
                                    <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>Change password for {{ $user->tertiary_unit->TertiaryUnitName }}.<br> &nbsp;&nbsp;&nbsp;&nbsp; <strong>Confirm changing your password by filling up below.&nbsp;<strong style="color:red"><i>Special characters like /,!,@,# are not allowed.</i> </strong> </strong></div>
                                     <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>Change password for {{ $user->tertiary_unit->TertiaryUnitAbbreviation }}.</div>

                                </div>
                             @if (Session::has('message'))
                                   <div class="alert alert-danger">{{ Session::get('message') }}</div>
                             @endif

                             @if (Session::has('message2'))
                                   <div class="alert alert-success">{{ Session::get('message2') }}</div>
                             @endif
                             @foreach($errors->all() as $error)
                                     <div class="alert alert-danger">{{ $error }}</div>
                             @endforeach
                                <!--./div class row-->
                                <form name="frmChangePass" novalidate="" >
                                    <label>Old password:</label>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='password' name="old_password" autocomplete="off" required ng-touched />
                                        <br><br>

                                    <label>New password:</label>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type='password' name="new_password" autocomplete="off" required ng-touched />
                                       <br><br>

                                    <label>Re-enter New password:</label>
                                    
                                    &nbsp;&nbsp;&nbsp;<input type='password' name="password_again" autocomplete="off" required ng-touched />
                                </form>

                                <br><br><button type="submit" class="btn btn-success btn-sm ">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>

@endsection