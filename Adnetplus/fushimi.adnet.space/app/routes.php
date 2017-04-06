<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/
use App\System\Route;

// --------------------- Web -----------------------
Route::get('/', 'HomeController@index');

// --------------------- Admin -----------------------
Route::get('admin', 'Admin\HomeController@index');
Route::get('admin/login', 'Admin\AuthController@getLogin');
Route::post('admin/login', 'Admin\AuthController@postLogin');
Route::get('admin/logout', 'Admin\AuthController@logout');

// news
Route::get('admin/home', 'Admin\HomeController@index');
Route::post('admin/news/create', 'Admin\HomeController@create');
Route::post('admin/news/update', 'Admin\HomeController@update');
Route::post('admin/news/delete', 'Admin\HomeController@delete');
Route::get('admin/news/getById', 'Admin\HomeController@getById');

// topic
Route::get('admin/topic', 'Admin\TopicsController@index');
Route::post('admin/topic/create', 'Admin\TopicsController@create');
Route::post('admin/topic/update', 'Admin\TopicsController@update');
Route::post('admin/topic/delete', 'Admin\TopicsController@delete');
Route::get('admin/topic/getById', 'Admin\TopicsController@getById');

// Request Ajax
Route::post('admin/contact/recuirtContact', 'Admin\ContactController@recuirtContact');
Route::post('admin/contact/send-contact', 'Admin\ContactController@sendContact');
Route::post('admin/contact/send-contact-medical', 'Admin\ContactController@sendContactMedical');

// The requests come from frontend part
Route::get('admin/news', 'Admin\HomeController@getAllNews');
Route::get('admin/topics', 'Admin\TopicsController@getAllTopics');