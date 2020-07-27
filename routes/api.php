<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Api\AutomationController;
use App\Http\Controllers\Api\SendPulseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExportController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ObjectController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);

    Route::post('export', [ExportController::class, 'store']);

    Route::get('event', [EventController::class, 'index']);
    Route::get('event/{event}/fields', [EventController::class, 'show']);

    Route::get('object', [ObjectController::class, 'index']);
    Route::get('object/{object}/fields', [ObjectController::class, 'show']);
    Route::post('export', [ExportController::class, 'store']);

    Route::get('automation', [AutomationController::class, 'index']);
    Route::get('automation/{id}', [AutomationController::class, 'show']);
    Route::post('automation/new', [AutomationController::class, 'store']);
    Route::post('automation/{id}', [AutomationController::class, 'update']);
    Route::post('automation', [AutomationController::class, 'store']);
    Route::delete('automation/{id}', [AutomationController::class, 'destroy']);

    Route::get('addressbooks', [SendPulseController::class, 'listAddressBooks']);

    Route::post('oauth/sendpulse', [OAuthController::class, 'redirectToLoginForm']);
    Route::get('oauth/sendpulse/callback', [OAuthController::class, 'handleCallback']);
});

Route::post('/uninstall', [OAuthController::class, 'uninstall']);
Route::group(['middleware' => 'guest:api'], function () {
    Route::match(['get', 'post'], '/install', [OAuthController::class, 'install']);
    Route::match(['get', 'post'], '/login', [OAuthController::class, 'login']);
});

