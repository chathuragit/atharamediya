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

Route::get('/', 'HomeController@index')->name('home');


/*Route::get('/{slug}', function(){
    return Request::segment(1);

});*/

Route::get('/all-ads', 'HomeController@all_ads')->name('all_ads');
Route::get('/ads', 'HomeController@all_ads')->name('ads');
Route::get('/advertisment/{slug}', 'HomeController@advertisment')->name('ads');

Route::get('/members', 'HomeController@members')->name('members');
Route::get('/member/{slug}', 'HomeController@member')->name('member');
Route::get('/adcollectors', 'HomeController@ad_collectors')->name('adcollectors');
Route::get('/adcollector/{slug}', 'HomeController@ad_collector')->name('adcollector');
Route::get('/services', 'HomeController@all_ads')->name('all_ads');

Auth::routes();

Route::group(['middleware' => ['SuperAdministrator']], function () {
    Route::post('/administrators/change_status', 'AdministratorController@change_status');
    Route::get('/administrators/change_password/{id}', 'AdministratorController@changePasswordRequest');
    Route::post('/administrators/change_password', 'AdministratorController@changePassword');
    Route::get('/administrators/filter', 'AdministratorController@filter');
    Route::resource('/administrators', 'AdministratorController');


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

    Route::post('/categories/change_status', 'CategoryController@change_status');
    Route::get('/categories/filter', 'CategoryController@filter');
    Route::resource('/categories', 'CategoryController');

    Route::get('/attributes/filter', 'AttributeController@filter');
    Route::post('/attributes/change_status', 'AttributeController@change_status');
    Route::resource('/attributes', 'AttributeController')->middleware('SuperAdministrator');

    Route::get('/logs/filter', 'LogController@filter');
    Route::get('/logs', 'LogController@index');

    Route::get('/pages', 'PagesController@index')->name('pages');
    Route::get('/pages/{id}/edit', 'PagesController@edit')->name('pages');
    Route::post('/pages/{id}/update', 'PagesController@update')->name('pages');
    Route::get('/pages/filter', 'PagesController@filter');
});

Route::get('/dashboard', 'DashboardController@index')->name('Dashboard');



//Route::resource('/administrators', 'AdministratorController')->middleware('SuperAdministrator');

Route::get('/advertisments_active', 'AdvertismentController@index');
Route::get('/advertisments_pending', 'AdvertismentController@index');
Route::get('/advertisments_expired', 'AdvertismentController@index');
Route::get('/advertisments_blocked', 'AdvertismentController@index');
Route::post('/advertisments/advertisment_attributes', 'AdvertismentController@advertisment_attributes');
Route::post('/advertisments/sub_categories', 'AdvertismentController@sub_categories');
Route::get('/advertisments/filter', 'AdvertismentController@filter');
Route::post('/advertisments/change_status', 'AdvertismentController@change_status');
Route::get('/remove_advertisment_image', 'AdvertismentController@remove_image');
Route::resource('/advertisments', 'AdvertismentController');

Route::post('/profile/change_credentials', 'ProfileController@change_credentials');
Route::get('/profile', 'ProfileController@index');

Route::get('/banners/filter', 'BannerController@filter');
Route::post('/banners/change_status', 'BannerController@change_status');
Route::resource('/banners', 'BannerController');



