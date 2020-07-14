<?php

use Illuminate\Support\Facades\Route;

Route::get('/point', 'HomeController@index')->name('home');
//Route::get('/test', 'SendPulseController@addressbooks');
Route::get('/test', 'HomeController@test');
