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

/*LOGIN ROUTE*/
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@doLogout');

/*DASHBOARD*/
Route::get('chief/dashboard', 'ChiefLoginController@dashboard');
Route::get('unit/dashboard', 'UnitLoginController@dashboard');
Route::get('staff/dashboard', 'StaffLoginController@dashboard');

/*UNIT USER ROUTES*/
Route::get('unit/objectives', 'APIUnitObjectivesController@showIndex');
Route::get('unit/setscorecard', 'UnitSetScorecardController@index');
Route::get('unit/scorecard', 'UnitScorecardController@showIndex');
Route::get('unit/measures','APIUnitMeasuresController@showIndex');
Route::get('unit/audit_trails', 'APIUnitAuditTrailsController@showIndex');


Route::get('staff/dashboard', 'StaffLoginController@dashboard');
Route::get('staff/objectives', 'APIStaffObjectivesController@showIndex');

/*CHIEF USER ROUTES*/
Route::get('chief/measures','APIChiefMeasuresController@showIndex');

/*STAFF USER ROUTES*/

/* DASHBOARD APPLETS */
Route::get('unit/unitdashboard', 'APIUnitAuditTrailsDashController@showIndex');

/*API ROUTES*/
Route::resource('api/unit_objectives','APIUnitObjectivesController');
Route::resource('api/unit_measures','APIUnitMeasuresController');
Route::resource('api/unit_audit_trails','APIUnitAuditTrailsController');
Route::resource('api/unit_dashboard','APIUnitAuditTrailsDashController');
Route::resource('api/staff_objectives', 'APIStaffObjectivesController');
Route::resource('api/chief_measures','APIChiefMeasuresController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
