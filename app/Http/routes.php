<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

/*REPORTS ROUTES*/
Route::get('report/yearlyUnitScorecard', 'ReportsController@yearlyUnitScorecard');

/*LOGIN ROUTE*/
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@doLogout');

/*DASHBOARD*/
Route::get('unit/dashboard', 'UnitLoginController@dashboard');
Route::get('unit/unitdashboard', 'APIUnitAuditTrailsDashController@showIndex');
Route::get('staff/dashboard', 'StaffLoginController@dashboard');
Route::get('staff/staffdashboard', 'APIStaffAuditTrailsDashController@showIndex');
Route::get('chief/dashboard', 'ChiefLoginController@dashboard');
Route::get('chief/chiefdashboard', 'APIChiefAuditTrailsDashController@showIndex');

/*BARGRAPH*/
Route::post('bargraph', 'StaffLoginController@bargraph');


/*UNIT USER ROUTES*/
Route::get('unit/scorecard', 'UnitLoginController@scorecard');
Route::get('unit/objectives', 'APIUnitObjectivesController@showIndex');
Route::get('unit/measures','APIUnitMeasuresController@showIndex');
Route::get('unit/audit_trails', 'APIUnitAuditTrailsController@showIndex');
Route::get('unit/targets','APIUnitTargetsController@showIndex');
Route::get('unit/targets/{id}','APIUnitTargetsController@edit');
Route::get('unit/reports','ReportsController@unitIndex');


/*STAFF USER ROUTES*/
Route::get('staff/scorecard', 'StaffLoginController@scorecard');
Route::get('staff/dashboard', 'StaffLoginController@dashboard');
Route::get('staff/objectives', 'APIStaffObjectivesController@showIndex');
Route::get('staff/measures','APIStaffMeasuresController@showIndex');
Route::get('staff/targets','APIStaffTargetsController@showIndex');
Route::get('staff/targets/{id}','APIStaffTargetsController@edit');
Route::get('staff/audit_trails', 'APIStaffAuditTrailsController@showIndex');

/*CHIEF USER ROUTES*/
Route::get('chief/scorecard', 'ChiefLoginController@scorecard');
Route::get('chief/objectives', 'APIChiefObjectivesController@showIndex');
Route::get('chief/measures','APIChiefMeasuresController@showIndex');
Route::get('chief/targets','APIChiefTargetsController@showIndex');
Route::get('chief/targets/{id}','APIChiefTargetsController@edit');
Route::get('chief/audit_trails', 'APIChiefAuditTrailsController@showIndex');



/*API ROUTES*/
Route::resource('api/unit_objectives','APIUnitObjectivesController');
Route::resource('api/unit_measures','APIUnitMeasuresController');
Route::resource('api/unit_audit_trails','APIUnitAuditTrailsController');
Route::resource('api/unit_dashboard','APIUnitAuditTrailsDashController');
Route::resource('api/staff_dashboard','APIStaffAuditTrailsDashController');
Route::resource('api/staff_objectives', 'APIStaffObjectivesController');
Route::resource('api/chief_objectives', 'APIChiefObjectivesController');
Route::resource('api/staff_audit_trails','APIStaffAuditTrailsController');
Route::resource('api/chief_audit_trails','APIChiefAuditTrailsController');
Route::resource('api/chief_dashboard','APIChiefAuditTrailsDashController');
Route::get('api/perspectives', 'PerspectiveController@allPerspectives');
Route::get('api/staff/objectives/chiefobjectives', 'APIStaffObjectivesController@chief_objectives');
Route::get('api/unit/objectives/staffobjectives', 'APIUnitObjectivesController@staff_objectives');

Route::resource('api/chief_scorecard', 'APIChiefScorecardController');
Route::resource('api/staff_scorecard', 'APIStaffScorecardController');
Route::resource('api/unit_scorecard', 'APIUnitScorecardController');
Route::resource('api/chief_measures','APIChiefMeasuresController');
Route::resource('api/staff_measures','APIStaffMeasuresController');
Route::resource('api/chief_targets','APIChiefTargetsController');
Route::resource('api/staff_targets','APIStaffTargetsController');
Route::resource('api/unit_targets','APIUnitTargetsController');
	
Route::post('api/chief_targets/update/{id}','APIChiefTargetsController@updatetarget');
Route::post('api/chief_targets/updatequarter/{id}','APIChiefTargetsController@updatequarter');

Route::post('api/staff_targets/update/{id}','APIStaffTargetsController@updatestafftarget');
Route::post('api/staff_targets/updatequarter/{id}','APIStaffTargetsController@updatestaffquarter');

Route::post('api/unit_targets/update/{id}','APIUnitTargetsController@updateunitarget');
Route::post('api/unit_targets/updatequarter/{id}','APIUnitTargetsController@updateunitquarter');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
