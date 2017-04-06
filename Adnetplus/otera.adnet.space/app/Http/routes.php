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

// admin login
Route::get('staff/login', ['as' => 'staff.getlogin', 'uses' => 'Auth\AuthController@staffLogin']);
Route::get('staff/logout', function () {
    \Auth::logout();
    return \Redirect::to('/staff/login');
});

Route::get('auth/login', ['as' => 'auth.getlogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.postlogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);
Route::get('/check-user', ['as' => 'check.user', 'uses' => 'Auth\AuthController@checkUserAdmin']);

// undertaker login
Route::get('undertaker/login', ['as' => 'undertaker.getlogin', 'uses' => 'Auth\UndertakerController@getLogin']);
Route::post('undertaker/login', ['as' => 'undertaker.postlogin', 'uses' => 'Auth\UndertakerController@postLogin']);
Route::get('undertaker/logout', ['as' => 'undertaker.logout', 'uses' => 'Auth\UndertakerController@logout']);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController');
    Route::resource('ot-requests', 'OtRequestsController');
    Route::get('ot-requests/{id}/staff', 'OtRequestsController@staff');
    Route::get('ot-requests/{id}/staff-sendmail', 'OtRequestsController@staffSendMail');// button 依頼を確定する click send mail
    Route::get('ot-requests/{id}/choose', 'OtRequestsController@chooseStafff');
    Route::post('ot-requests/{id}/done', 'OtRequestsController@doneRequest');
    Route::post('ot-requests/{id}/process-choose', 'OtRequestsController@chooseProcess');
    Route::get('ot-requests/{id}/answer', 'OtRequestsController@answerRequest');
    Route::get('ot-requests/{id}/confirm-request', 'OtRequestsController@showRequest');
    Route::get('user-confirmed/delete/{id}', 'OtRequestsController@deleteUserConfirmed');
    Route::resource('undertaker', 'UndertakerController');
});

Route::group(['namespace' => 'Under', 'prefix' => 'under', 'middleware' => 'undertaker'], function () {
    Route::resource('ucontact', 'UContactController');
    Route::resource('urequest', 'URequestController');
    Route::post('/urequest-confirm', ['as' => 'undertaker.urequestconfirm', 'uses' => 'URequestController@addRequest']);
});

Route::group(['namespace' => 'Staff', 'prefix' => 'staff', 'middleware' => 'auth'], function () {
    Route::resource('staffrequest', 'MRequestController');
    Route::get('staffrequesget/successt', 'MRequestController@success');
});

Route::get('/', function () {
    //return Redirect::route('staff.getlogin');
});


Route::get('/test-sendmail', function () {

    $header = "Reply-To: The Sender <no-reply@otera.adnet.space>\r\n";
    $header .= "Return-Path: The Sender <no-reply@otera.adnet.space>\r\n";
    //$header .= "From:The Sender <no-reply@otera.adnet.space>\n";
    $header .= "MIME-Version: 1.0\n";

    // send mail to admin
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    //email admin
    $to = \Config::get('setting.admin_email');
    $subject = 'Test Send mail Spam';
    $body = '';
    $body .= "様からお問い合わせがありました。\n";
    $body .= "メールアドレス: \n\n";
    $body .= "お問い合わせ内容 \n";
    $body .= "件名: \n";
    $body .= "内容: \n";
    $body .= mb_convert_encoding("①②③", "ISO-2022-JP-MS") . "\n";

    mb_send_mail("hunglv.adnetplus@gmail.com", $subject, $body, $header);
});

