<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AutomationController;
use App\Http\Controllers\Api\SendPulseController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('user', 'UserController')->only(['index', 'store']);
    Route::apiResource('export', 'ExportController@store')->only('store');
    Route::apiResource('source', 'SourceController')->only(['index', 'show']);

    Route::get('automation', [AutomationController::class, 'index']);
    Route::get('automation/{id}', [AutomationController::class, 'show']);
    Route::post('automation/{id}', [AutomationController::class, 'update']);
    Route::post('automation', [AutomationController::class, 'store']);
    Route::delete('automation/{id}', [AutomationController::class, 'destroy']);


    Route::get('addressbooks', [SendPulseController::class, 'listAddressBooks']);
    Route::post('oauth/sendpulse', 'Auth\OAuthController@redirectToLoginForm');
    Route::get('oauth/sendpulse/callback', 'Auth\OAuthController@handleCallback');

});

Route::group(['middleware' => 'guest:api'], function () {
    // todo установки приложение и т.д.
    Route::get('point', 'HomeController@index');
//    Route::get('oauth/sendpulse/callback', 'Auth\OAuthController@handleCallback');

//    Route::post('login', 'Auth\LoginController@login');
//    Route::post('register', 'Auth\RegisterController@register');
//
//    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//
//    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
//    Route::post('email/resend', 'Auth\VerificationController@resend');
//
//    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
//    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

