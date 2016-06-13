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
#scorecard
Route::get('report/currentYearUnitScorecard', 'ReportsController@currentYearUnitScorecard');
Route::get('report/currentYearSecondaryUnitScorecard', 'ReportsController@currentYearSecondaryUnitScorecard');
Route::get('report/currentYearStaffScorecard', 'ReportsController@currentYearStaffScorecard');
Route::get('report/currentYearChiefScorecard', 'ReportsController@currentYearChiefScorecard');

Route::get('report/yearlyUnitScorecard', 'ReportsController@yearlyUnitScorecard');
Route::get('report/yearlyTertiaryUnitScorecard', 'ReportsController@yearlyTertiaryUnitScorecard');
Route::get('report/yearlySecondaryUnitScorecard', 'ReportsController@yearlySecondaryUnitScorecard');
Route::get('report/yearlyStaffScorecard', 'ReportsController@yearlyStaffScorecard');
Route::get('report/yearlyChiefScorecard', 'ReportsController@yearlyChiefScorecard');

Route::get('report/currentUnitScorecard/{id}', 'ReportsController@currentYearChiefUnitScorecard');
Route::get('report/currentSecondaryUnitScorecard/{id}', 'ReportsController@currentYearSearchableSecondaryUnitScorecard');
Route::get('report/currentTertriaryUnitScorecard/{id}', 'ReportsController@currentYearSearchableTertiaryUnitScorecard');
Route::get('report/currentStaffScorecard/{id}', 'ReportsController@currentYearChiefStaffScorecard');
Route::get('report/currentChiefScorecard/{id}', 'ReportsController@currentYearStaffChiefScorecard');

#analysis
Route::get('report/quarterlyUnitAnalysis', 'ReportsAnalysisController@quarterlyUnitAnalysis');
Route::get('report/quarterlySecondaryUnitAnalysis', 'ReportsAnalysisController@quarterlySecondaryUnitAnalysis');
Route::get('report/quarterlyTertiaryUnitAnalysis', 'ReportsAnalysisController@quarterlyTertiaryUnitAnalysis');
Route::get('report/quarterlyStaffAnalysis', 'ReportsAnalysisController@quarterlyStaffAnalysis');
Route::get('report/quarterlyChiefAnalysis', 'ReportsAnalysisController@quarterlyChiefAnalysis');

Route::get('report/yearlyUnitAnalysisBarGraph', 'ReportsAnalysisController@yearlyUnitAnalysisBarGraph');
Route::get('report/yearlySecondaryUnitAnalysisBarGraph', 'ReportsAnalysisController@yearlySecondaryUnitAnalysisBarGraph');
Route::get('report/yearlyTertiaryUnitAnalysisBarGraph', 'ReportsAnalysisController@yearlyTertiaryUnitAnalysisBarGraph');
Route::get('report/yearlyStaffAnalysisBarGraph', 'ReportsAnalysisController@yearlyStaffAnalysisBarGraph');
Route::get('report/yearlyChiefAnalysisBarGraph', 'ReportsAnalysisController@yearlyChiefAnalysisBarGraph');


/*LOGIN ROUTE*/
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@doLogout');

/*UTILITIES ROUTE*/
Route::post('change_password', 'ChangePasswordController@ChangePassword');
Route::post('change_picture', 'ChangePictureController@changePicture');
Route::post('api/unit_confirm_password', 'ChiefConfirmPasswordController@unitConfirmPassword');
Route::post('api/staff_confirm_password', 'ChiefConfirmPasswordController@staffConfirmPassword');
Route::post('api/chief_confirm_password', 'ChiefConfirmPasswordController@confirmPassword');
Route::post('api/secondary_unit_confirm_password', 'ChiefConfirmPasswordController@secondaryUnitConfirmPassword');
Route::post('api/tertiary_unit_confirm_password', 'ChiefConfirmPasswordController@tertiaryUnitConfirmPassword');


/*DASHBOARD*/
Route::get('unit/dashboard', 'UnitLoginController@dashboard');
Route::get('unit/unitdashboard', 'APIUnitAuditTrailsDashController@showIndex');
Route::get('staff/dashboard', 'StaffLoginController@dashboard');
Route::get('staff/staffdashboard', 'APIStaffAuditTrailsDashController@showIndex');
Route::get('chief/dashboard', 'ChiefLoginController@dashboard');
Route::get('chief/chiefdashboard', 'APIChiefAuditTrailsDashController@showIndex');

Route::get('secondary_unit/dashboard', 'SecondaryUnitLoginController@dashboard');


Route::get('tertiary/dashboard', 'TertiaryUnitLoginController@dashboard');


/*BARGRAPH*/
Route::post('bargraphunit', 'UnitLoginController@bargraph');
Route::post('bargraphsecondaryunit', 'SecondaryUnitLoginController@bargraph');
Route::post('bargraph', 'StaffLoginController@bargraph');
Route::post('bargraphchief', 'ChiefLoginController@bargraph');
Route::post('bargraphtertiaryunit', 'TertiaryUnitLoginController@bargraph');

/*DONUTGRAPH*/
Route::post('donutgraphunit', 'UnitLoginController@donutgraph');
Route::post('donutgraphsecondaryunit', 'SecondaryUnitLoginController@donutgraph');
Route::post('donutgraphstaff', 'StaffLoginController@donutgraph');
Route::post('donutgraphchief', 'ChiefLoginController@donutgraph');
Route::post('donutgraphtertiaryunit', 'TertiaryUnitLoginController@donutgraph');



/*SEARCHUNIT*/
Route::post('searchunit', 'ChiefLoginController@searchunit');
Route::post('searchstaff', 'StaffLoginController@searchstaff');


/*UNIT USER ROUTES*/
Route::get('unit/scorecard', 'UnitLoginController@scorecard');
Route::get('unit/objectives', 'APIUnitObjectivesController@showIndex');
Route::get('unit/measures','APIUnitMeasuresController@showIndex');
Route::get('unit/audit_trails', 'APIUnitAuditTrailsController@showIndex');
Route::get('unit/targets','APIUnitTargetsController@showIndex');
Route::get('unit/targets/{id}','APIUnitTargetsController@edit');
Route::get('unit/reports','ReportsController@unitIndex');
Route::get('unit/changepassword','UnitLoginController@changepass');
Route::get('unit/changeunitpicture', 'UnitLoginController@changeunitpicture');
Route::get('unit/changeuserpicture', 'UnitLoginController@changeuserpicture');
Route::get('unit/analysis_reports','ReportsAnalysisController@unitIndex');


/*STAFF USER ROUTES*/
Route::get('staff/scorecard', 'StaffLoginController@scorecard');
Route::get('staff/dashboard', 'StaffLoginController@dashboard');
Route::get('staff/objectives', 'APIStaffObjectivesController@showIndex');
Route::get('staff/measures','APIStaffMeasuresController@showIndex');
Route::get('staff/targets','APIStaffTargetsController@showIndex');
Route::get('staff/targets/{id}','APIStaffTargetsController@edit');
Route::get('staff/audit_trails', 'APIStaffAuditTrailsController@showIndex');
Route::get('staff/reports','ReportsController@staffIndex');
Route::get('staff/changepassword','StaffLoginController@changepass');
Route::get('staff/changestaffpicture', 'StaffLoginController@changestaffpicture');
Route::get('staff/changeuserpicture', 'StaffLoginController@changeuserpicture');
Route::get('staff/analysis_reports','ReportsAnalysisController@staffIndex');

//Route::post('staff/ajaxchiefmeasure', 'APIStaffMeasuresController@ajaxchiefmeasure');
Route::get('staff/angularchiefmeasure/{measureID}', 'APIStaffMeasuresController@angularchiefmeasure');
Route::get('unit/angularstaffmeasure/{measureID}', 'APIUnitMeasuresController@angularstaffmeasure');
Route::get('secondary_unit/angularunitmeasure/{measureID}', 'APISecondaryUnitMeasuresController@angularunitmeasure');
/*CHIEF USER ROUTES*/
Route::get('chief/scorecard', 'ChiefLoginController@scorecard');
Route::get('chief/objectives', 'APIChiefObjectivesController@showIndex');
Route::get('chief/measures','APIChiefMeasuresController@showIndex');
Route::get('chief/targets','APIChiefTargetsController@showIndex');
Route::get('chief/targets/{id}','APIChiefTargetsController@edit');
Route::get('chief/audit_trails', 'APIChiefAuditTrailsController@showIndex');
Route::get('chief/reports','ReportsController@chiefIndex');
Route::get('chief/changepassword','ChiefLoginController@changepass');
Route::get('chief/changechiefpicture', 'ChiefLoginController@changechiefpicture');
Route::get('chief/changeuserpicture', 'ChiefLoginController@changeuserpicture');
Route::get('chief/analysis_reports','ReportsAnalysisController@chiefIndex');


/* SECONDARY USER */
Route::get('secondary_unit/objectives', 'APISecondaryUnitObjectivesController@showIndex');
Route::get('secondary_unit/measures', 'APISecondaryUnitMeasuresController@showIndex');
Route::get('secondary_unit/targets', 'APISecondaryUnitTargetsController@showIndex');
Route::get('secondary_unit/scorecard', 'SecondaryUnitLoginController@scorecard');

Route::get('secondary_unit/targets/{id}','APISecondaryUnitTargetsController@edit');
Route::get('secondary_unit/scorecard', 'SecondaryUnitLoginController@scorecard');
Route::get('secondary_unit/reports','ReportsController@secondaryIndex');
Route::get('secondary_unit/analysis_reports','ReportsAnalysisController@secondaryIndex');
Route::get('secondary_unit/changesecondaryunitpicture', 'SecondaryUnitLoginController@changesecondaryunitpicture');
Route::get('secondary_unit/changeuserpicture', 'SecondaryUnitLoginController@changeuserpicture');
Route::get('secondary_unit/changepassword','SecondaryUnitLoginController@changepass');
Route::get('secondary_unit/audit_trails', 'APISecondaryUnitAuditTrailsController@showIndex');



/* TERTIARY USER */
Route::get('tertiary_unit/scorecard', 'TertiaryUnitLoginController@scorecard');
Route::get('tertiary_unit/objectives', 'APITertiaryUnitObjectivesController@showIndex');
Route::get('tertiary_unit/measures','APITertiaryUnitMeasuresController@showIndex');
Route::get('tertiary_unit/targets', 'APITertiaryUnitTargetsController@showIndex');
Route::get('tertiary_unit/changepassword','TertiaryUnitLoginController@changepass');
Route::get('tertiary_unit/changetertiarypicture', 'TertiaryUnitLoginController@changetertiarypicture');
Route::get('tertiary_unit/changeuserpicture', 'TertiaryUnitLoginController@changeuserpicture');
Route::get('tertiary_unit/audit_trails', 'APITertiaryUnitAuditTrailsController@showIndex');
Route::get('tertiary_unit/reports','ReportsController@tertiaryIndex');
Route::get('tertiary_unit/analysis_reports','ReportsAnalysisController@tertiaryIndex');


/*API ROUTES*/

/*API ROUTES FOR TERTIARY*/
Route::get('api/tertiary_unit_scorecard/lastupdatedby', 'APITertiaryUnitScorecardController@LastUpdatedBy');
Route::resource('api/tertiary_unit_scorecard', 'APITertiaryUnitScorecardController');

Route::post('api/tertiary_unit_targets/update/{id}','APITertiaryUnitTargetsController@updatetertiaryunitarget');
Route::post('api/tertiary_unit_targets/updatequarter/{id}','APITertiaryUnitTargetsController@updatetertiaryunitquarter');
Route::resource('api/tertiary_unit_targets','APITertiaryUnitTargetsController');

Route::get('api/secondary_unit/measures/secondary_unit_measures', 'APITertiaryUnitMeasuresController@secondary_unit_measures');
Route::get('api/tertiary_unit/measures/tertiary_unit_objectives', 'APITertiaryUnitMeasuresController@tertiary_unit_objectives');
Route::resource('api/tertiary_unit_measures','APITertiaryUnitMeasuresController');
Route::resource('api/tertiary_unit_objectives','APITertiaryUnitObjectivesController');


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
Route::resource('api/secondary_unit_objectives', 'APISecondaryUnitObjectivesController');
Route::resource('api/secondary_unit_measures', 'APISecondaryUnitMeasuresController');
Route::resource('api/secondary_unit_dashboard','APISecondaryUnitAuditTrailsDashController');
Route::resource('api/tertiary_unit_dashboard','APITertiaryUnitAuditTrailsDashController');
Route::get('api/perspectives', 'PerspectiveController@allPerspectives');
Route::get('api/staff/objectives/chiefobjectives', 'APIStaffObjectivesController@chief_objectives');
Route::get('api/unit/objectives/staffobjectives', 'APIUnitObjectivesController@staff_objectives');

Route::get('api/secondary_unit_objectives/unitobjectives', 'APISecondaryUnitObjectivesController@unit_objectives');
Route::get('api/secondaryunit/measures/secondaryunitobjectives' , 'APISecondaryUnitMeasuresController@secondaryunitobjectives');
Route::get('api/secondaryunit/measures/unitmeasures', 'APISecondaryUnitMeasuresController@unit_measures');

Route::get('api/staff/measures/chiefmeasures', 'APIStaffMeasuresController@chief_measures');
Route::get('api/staff/measures/staffobjectives', 'APIStaffMeasuresController@staff_objectives');
Route::get('api/unit/measures/unitobjectives', 'APIUnitMeasuresController@unit_objectives');
Route::get('api/staff/measures/staffmeasures', 'APIUnitMeasuresController@staff_measures');

Route::get('api/unit_scorecard/lastupdatedby', 'APIUnitScorecardController@LastUpdatedBy');
Route::get('api/staff_scorecard/lastupdatedby', 'APIStaffScorecardController@LastUpdatedBy');
Route::get('api/chief_scorecard/lastupdatedby', 'APIChiefScorecardController@LastUpdatedBy');
Route::get('api/secondary_unit/lastupdatedby', 'APISecondaryUnitScorecardController@LastUpdatedBy');
Route::resource('api/secondary_unit_scorecard', 'APITertiaryUnitScorecardController');


Route::resource('api/chief_scorecard', 'APIChiefScorecardController');
Route::resource('api/staff_scorecard', 'APIStaffScorecardController');
Route::resource('api/unit_scorecard', 'APIUnitScorecardController');
Route::resource('api/secondary_unit_scorecard', 'APISecondaryUnitScorecardController');
Route::resource('api/chief_measures','APIChiefMeasuresController');
Route::resource('api/staff_measures','APIStaffMeasuresController');
Route::resource('api/chief_targets','APIChiefTargetsController');
Route::resource('api/staff_targets','APIStaffTargetsController');
Route::resource('api/unit_targets','APIUnitTargetsController');
Route::resource('api/secondary_targets','APISecondaryUnitTargetsController');

Route::resource('api/tertiary_unit_audit_trails','APITertiaryUnitAuditTrailsController');
Route::resource('api/secondary_unit_audit_trails','APISecondaryUnitAuditTrailsController');


Route::post('api/secondary_targets/update/{id}','APISecondaryUnitTargetsController@updatetarget');
Route::post('api/secondary_targets/updatequarter/{id}','APISecondaryUnitTargetsController@updatequarter');

	
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
