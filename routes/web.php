<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::any('webhook/{event}/{hash}', [WebhookController::class, 'index']);
