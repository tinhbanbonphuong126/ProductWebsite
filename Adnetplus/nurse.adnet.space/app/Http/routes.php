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

Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');
Route::post('/admin/login','AdminAuth\AuthController@login');

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {

    // Admin homepage
    Route::get('/', 'Admin\HomeController@index');

    // Login Routes...
    Route::get('logout','AdminAuth\AuthController@logout');
    
    // staff
    Route::get('/staff', ['as' => 'admin.sort.staffs', 'uses' => 'Admin\HomeController@index']);
    Route::get('staff/edit/{id}', 'Admin\StaffsController@getEdit');
    Route::post('staff/edit', 'Admin\StaffsController@postEdit');
    Route::get('staff/add', 'Admin\StaffsController@getAdd');
    Route::post('staff/add', 'Admin\StaffsController@postAdd');

    // user
    Route::get('user', ['as' => 'admin.sort.users', 'uses' => 'Admin\UsersController@index']);
    Route::get('user/calendar/{id}', 'Admin\UsersController@calendar');
    Route::get('user/edit/{id}', 'Admin\UsersController@getEdit');
    Route::post('user/edit', 'Admin\UsersController@postEdit');
    Route::get('user/add', 'Admin\UsersController@getAdd');
    Route::post('user/add', 'Admin\UsersController@postAdd');

    // medical records
    Route::get('medical-record/show/{userId}/{day}', 'Admin\MedicalRecordsController@show');
    Route::get('medical-record/add/{userId}', 'Admin\MedicalRecordsController@getAdd');
    Route::post('medical-record/add/{userId}', 'Admin\MedicalRecordsController@postAdd');
    Route::get('medical-record/edit/{userId}/{day}', 'Admin\MedicalRecordsController@getEdit');
    Route::post('medical-record/edit/{userId}/{day}', 'Admin\MedicalRecordsController@postEdit');

    // medical record format
    Route::get('medical-record-format/{type}', 'Admin\MedicalRecordFormatsController@getEdit');
    Route::post('medical-record-format/{type}', 'Admin\MedicalRecordFormatsController@postEdit');
});

Route::group(['middleware' => 'web'], function () {

    // web homepage
    Route::get('/', 'HomeController@index');

    //Route::auth();
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // multiple languages
    Route::get('locale/{locale}', ['as' => 'locale.setLocale', 'uses' => 'LocaleController@setLocale']);

    Route::get('home', 'HomeController@index');
    Route::get('search', ['as' => 'search.users', 'uses' => 'HomeController@index']);

    // users
    Route::get('user/show/{id}', 'UsersController@show');
    Route::get('user/calendar/{id}', 'UsersController@calendar');

    // medical records
    Route::get('medical-record/show/{userId}/{day}', 'MedicalRecordsController@show');
    Route::get('medical-record/add/{userId}', 'MedicalRecordsController@getAdd');
    Route::post('medical-record/add/{userId}', 'MedicalRecordsController@postAdd');
    Route::get('medical-record/edit/{userId}/{day}', 'MedicalRecordsController@getEdit');
    Route::post('medical-record/edit/{userId}/{day}', 'MedicalRecordsController@postEdit');
});

