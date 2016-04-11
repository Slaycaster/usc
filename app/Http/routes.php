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

/*UNIT USER ROUTES*/
Route::get('unit/dashboard', 'UnitLoginController@dashboard');
Route::post('unit/login', 'UnitLoginController@doLogin');
Route::get('unit/logout', 'UnitLoginController@doLogout');
Route::get('unit/objectives', 'UnitObjectivesController@index');
Route::get('unit/setscorecard', 'UnitSetScorecardController@index');
Route::get('unit/scorecard', 'UnitScorecardController@index');
Route::get('unit/measures','APIUnitMeasuresController@showIndex');
Route::get('unit/activity_logs', 'UnitActivityLogsController@index');


/*API ROUTES*/
Route::resource('api/unit_objectives','APIUnitObjectivesController');
Route::resource('api/unit_measures','APIUnitMeasuresController');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
