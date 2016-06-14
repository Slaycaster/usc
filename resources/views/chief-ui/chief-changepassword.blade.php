@extends('layout-chief')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/password.js') }}"></script>

    <script src="{{ asset('js/validatepassword.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="APIChiefPasswordController">
       <form action="{{url('change_password')}}" name="passwordform" method="post">
            <div class="wrap">
                <div class="row">           
                    <div class="col-lg-12">
                        <div class="panel panel-warning measures-custom-panel">
                            <div class="panel-heading measures-custom-heading">
                                <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>
                                {{ $chief_user->rank->RankCode }} 
                                {{ $chief_user->UserChiefFirstName }} 
                                {{ $chief_user->UserChiefLastName }} 
                                Change Password</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="panel-body">
                                <!--/.div class row-->
                                <div class="row">
                                    <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>
                                    Hi
                                    {{ $chief_user->rank->RankCode }} 
                                    {{ $chief_user->UserChiefFirstName }} 
                                    {{ $chief_user->UserChiefLastName }}!&nbsp;
                                    Change your password by filling up the form below.&nbsp;</div>
                                     <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>
                                    {{ $chief_user->rank->RankCode }} 
                                    {{ $chief_user->UserChiefFirstName }} 
                                    {{ $chief_user->UserChiefLastName }}!&nbsp;
                                    Change your password by filling up the form below.</div>

                                </div>
                                 @if (Session::has('message'))
                                       <div class="alert alert-danger">{{ Session::get('message') }}</div>
                                 @endif

                                 @if (Session::has('message2'))
                                       <div class="alert alert-success">{{ Session::get('message2') }}</div>
                                 @endif
                                 @if ($errors->all())
                                         <div class="alert alert-danger">Error changing password. Please try again.</div>
                                 @endif
                                <!--./div class row-->
                                
                                <form name="frmChangePass" novalidate="" >
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            <div class="col-md-3">  
                                                <label  style="margin:.5em;">Enter Old password:</label>
                                            </div>
                                            
                                            <div class="col-md-3">  
                                                <input type='password' onkeyup="check();" id="old_password" class="form-control" name="old_password" autocomplete="off" required ng-touched />
                                            </div>
                                    
                                            <div class="col-md-6"><br /><br /></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">  
                                                <label style="margin:.5em;">Enter New password:</label>
                                            </div>
                                            <div class="col-md-3">  
                                                <input type='password' class="form-control" onkeyup="passwordconfirm();" name="new_password" id="new_password" autocomplete="off" required ng-touched />
                                            </div>

                                            <div class="col-md-6">
                                                <p  id="new_pass_error" style="margin:.5em; color: #a94442;"></p>
                                                <p  id="new_pass_ok" style="margin:.5em; color: #3c763d;"></p>
                                                <br /><br />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">  
                                                <label style="margin:.5em;">Re-enter New password:</label>
                                            </div>
                                            <div class="col-md-3">  
                                                 <input type='password' class="form-control" onkeyup="retypepass();" id="password_again" name="password_again" autocomplete="off" required ng-touched disabled="" />

                                            </div>    
                                            <div class="col-md-4"> 
                                                <p  id="error_message" style="margin:.5em; color: #a94442;"></p>
                                                <p  id="success_message" style="margin:.5em;color: #3c763d;"></p>
                                            </div>
                                        
                                            <div class="col-md-3"></div>
                                        </div>
                                         <div class="col-md-12">
                                            <div  class="col-md-3 col-md-offset-3">
                                                <br />
                                                <button type="submit" id="submitbtn" class="btn btn-success btn-sm col-md-12" disabled="">Change Password</button>
                                            </div>  
                                        </div>
                                    </div>                                
                                </form>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>
   

@endsection