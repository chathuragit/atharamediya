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

Route::resource('/administrators', 'AdministratorController')->middleware('SuperAdministrator');
Route::resource('/advertisement_collectors', 'AdvertisementCollectorController')->middleware('SuperAdministrator');
Route::resource('/advertising_members', 'AdvertisingMemberController')->middleware('SuperAdministrator');
Route::resource('/web_space_holders', 'WebSpaceHolderController')->middleware('SuperAdministrator');
Route::resource('/individual_advertisers', 'IndividualAdvertiserController')->middleware('SuperAdministrator');



