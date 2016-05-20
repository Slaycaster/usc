@extends('layout-unit')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp" ng-controller="UnitLoginController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning measures-custom-panel">
						<div class="panel-heading measures-custom-heading">
							<i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $user->unit->UnitAbbreviation }} Change Password</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<!--/.div class row-->
							<div class="row">
                                <div ng-show="info" class="alert alert-info objective-info-name"><i class="fa fa-info-circle fa-fw"></i>Change password for {{ $user->unit->UnitName }}.<br> &nbsp;&nbsp;&nbsp;&nbsp; <strong>Confirm changing your password by filling up below.&nbsp;<strong style="color:red"><i>Special characters like /,!,@,# are not allowed.</i> </strong> </strong></div>
                                 <div ng-show="info" class="alert alert-info objective-info-abb"><i class="fa fa-info-circle fa-fw"></i>Change password for {{ $user->unit->UnitAbbreviation }}.</div>

                            </div>
							<!--./div class row-->

                            <form name="frmChangePass" novalidate="">
                            	
                            	<label>Old password:</label>
                            	
                            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='password' id="id_old_password" name="old_password" value="" ng-model="" autocomplete="off" required ng-touched />
                                    <br><br>

                            	<label>New password:</label>
                            	
                            	&nbsp;&nbsp;&nbsp;&nbsp;<input type='password' id="id_new_password" name="new_password" value="" ng-model="" autocomplete="off" required ng-touched />
                                   <br><br>

                            	<label>Re-enter New password:</label>
                            	
                            	&nbsp;&nbsp;&nbsp;<input type='password' id="id_new_password" name="new_password" value="" ng-model="" autocomplete="off" required ng-touched />
                                    
    							
                            	

                            </form>

							<br><br><button type="button" class="btn btn-success btn-sm" id="btn-save" ng-click="save('view', id)" ng-disabled="frmChangePass.$invalid">Save Password</button>
						</div>
					</div>
				</div>
			</div>
	    </div>

		<!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b>Change Password</b></h4>
                    </div>
                   	
                    <div class="modal-body">
                        <form name="frmChangePass" class="form-horizontal" novalidate="">
                            <i><strong>Are you sure to save the new password?</strong></i>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmChangePass.$invalid">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection