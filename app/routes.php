<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('user/{id}', 'UserController@showForm');
Route::post('user/newmessage/{id}', array('before'=>'csrf','uses' => 'UserController@retrieveInfo'));
Route::get('user/newissue/{id}','UserController@processIssue');

Route::get('/admin/main', array('before' => 'auth','uses' => 'AdminController@mainArea'));
Route::get('/admin/settings', array('before' => 'auth','uses' =>'SettingsController@mainArea'));
Route::get('/admin/account', array('before' => 'auth','uses' =>'AdminAccountController@mainArea'));
Route::get('/admin/account/company', array('before' => 'auth','uses' => 'AdminAccountController@companyForm'));
Route::get('/admin/settings/user', array('before' => 'auth','uses' =>'AdminAccountController@userForm'));
Route::post('/admin/settings/company', array('before' => 'auth','uses' =>'AdminAccountController@saveCompany'));
Route::post('/admin/settings/user', array('before' => 'auth','uses' =>'AdminAccountController@modifyUser'));


Route::get('/admin/settings/issues', array('before' => 'auth','uses' =>'SettingsController@allIssues'));
Route::get('/admin/settings/newissuetype',array('before' => 'auth','uses' =>'SettingsController@issueForm'));
Route::get('/admin/settings/issue/{id}', array('before' => 'auth','uses' =>'SettingsController@issueEdit'));
Route::post('/admin/settings/issue', array('before' => 'auth','uses' =>'SettingsController@createIssueType'));
Route::put('/admin/settings/issue/{id}', array('before' => 'auth','uses' =>'SettingsController@updateIssueType'));
Route::delete('/admin/settings/issue/{id}', array('before' => 'auth','uses' =>'SettingsController@deletemt'));

Route::get('/admin/issues', array('before' => 'auth','uses' =>'AdminController@allIssues'));
Route::get('/admin/issues/new', array('before' => 'auth','uses' =>'AdminController@newIssues'));
Route::get('/admin/issues/respond/{id}', array('before' => 'auth','uses' =>'AdminController@respondMessage'));
Route::put('/admin/issues/response/{id}', array('before' => 'auth','uses' =>'AdminController@saveResponse'));
  


Route::get('/admin/settings/discusionstatuses', array('before' => 'auth','uses' =>'SettingsController@allDiscussionStatuses'));
Route::get('/admin/settings/discusionstatus/new', array('before' => 'auth','uses' =>'SettingsController@formDiscussionStatus'));
Route::post('/admin/settings/discusionstatus', array('before' => 'auth','uses' =>'SettingsController@createDiscussionStatus'));
Route::get('/admin/settings/discusionstatus/{id}',array('before' => 'auth','uses'=>'SettingsController@editDiscussionStatus'));
Route::post('/admin/settings/discusionstatus/{id}', array('before' => 'auth','uses' =>'SettingsController@updateDiscussionStatus'));
Route::delete('/admin/settings/discusionstatus/{id}', array('before' => 'auth','uses' =>'SettingsController@deleteDiscussionStatus'));
Route::put('/admin/settings/discusionstatus/{id}', array('before' => 'auth','uses' =>'SettingsController@updateDiscussionStatus'));

Route::get('/admin/issues/update', array('before' => 'auth','uses' =>'AdminController@changeDiscussionsStatus'));
Route::get('/admin/issues/{id}', array('before' => 'auth','uses' =>'AdminController@changeDiscussionStatus'));


Route::post('/admin/getshortlink/{id}', array('before' => 'auth','uses' =>'AdminController@generateShortLink'));
Route::get('/admin/generateqr/{id}', array('before' => 'auth','uses' =>'AdminController@genereateQR'));
Route::get('/admin/downloadqr/{id}', array('before' => 'auth','uses' =>'AdminController@downloadQR'));
header('Access-Control-Allow-Origin: *');
Route::get('/admin/apartaments', array('before' => 'auth','uses' =>'AdminController@apartamentsArea'));
Route::get('/admin/apartaments/new', array('before' => 'auth','uses' =>'AdminController@formApartament'));
Route::get('/admin/apartaments/{id}', array('before' => 'auth','uses' =>'AdminController@editApartment'));
Route::post('/admin/apartaments',array('before' => 'auth','uses' =>'AdminController@createApartament'));
Route::put('/admin/apartaments/{id}', array('before' => 'auth','uses' =>'AdminController@updateApartament'));
Route::delete('/admin/apartaments/{id}', array('before' => 'auth','uses' =>'AdminController@deleteApartament'));




Route::get('/admin/login', 'AdminController@showLogin');
Route::get('/admin/logout', 'AdminController@getLogout');
//Route::get('/admin', 'AdminController@getIndex');
Route::post('/admin/login', array('uses' => 'AdminController@retrieveLogin'));
