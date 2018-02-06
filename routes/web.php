<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/Dashboard', 'HomeController@index')->name('home');

Route::post('/administrators/change_status', 'AdministratorController@change_status');
Route::get('/administrators/change_password/{id}', 'AdministratorController@changePasswordRequest');
Route::post('/administrators/change_password', 'AdministratorController@changePassword');
Route::get('/administrators/filter', 'AdministratorController@filter');
Route::resource('/administrators', 'AdministratorController');

//Route::resource('/administrators', 'AdministratorController')->middleware('SuperAdministrator');

Route::post('/advertisement_collectors/change_status', 'AdvertisementCollectorController@change_status');
Route::get('/advertisement_collectors/change_password/{id}', 'AdvertisementCollectorController@changePasswordRequest');
Route::post('/advertisement_collectors/change_password', 'AdvertisementCollectorController@changePassword');
Route::get('/advertisement_collectors/filter', 'AdvertisementCollectorController@filter');
Route::resource('/advertisement_collectors', 'AdvertisementCollectorController')->middleware('SuperAdministrator');

Route::post('/advertising_members/change_status', 'AdvertisingMemberController@change_status');
Route::get('/advertising_members/change_password/{id}', 'AdvertisingMemberController@changePasswordRequest');
Route::post('/advertising_members/change_password', 'AdvertisingMemberController@changePassword');
Route::get('/advertising_members/filter', 'AdvertisingMemberController@filter');
Route::resource('/advertising_members', 'AdvertisingMemberController')->middleware('SuperAdministrator');

Route::post('/web_space_holders/change_status', 'WebSpaceHolderController@change_status');
Route::get('/web_space_holders/change_password/{id}', 'WebSpaceHolderController@changePasswordRequest');
Route::post('/web_space_holders/change_password', 'WebSpaceHolderController@changePassword');
Route::get('/web_space_holders/filter', 'WebSpaceHolderController@filter');
Route::resource('/web_space_holders', 'WebSpaceHolderController')->middleware('SuperAdministrator');

Route::post('/individual_advertisers/change_status', 'IndividualAdvertiserController@change_status');
Route::get('/individual_advertisers/filter', 'IndividualAdvertiserController@filter');
Route::resource('/individual_advertisers', 'IndividualAdvertiserController')->middleware('SuperAdministrator');



