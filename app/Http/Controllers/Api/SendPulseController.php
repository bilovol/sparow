<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SendPulse\SendPulseService;

class SendPulseController extends Controller
{
    public function listAddressBooks(SendPulseService $sendPulseService)
    {
        return $sendPulseService->listAddressBooks();
    }
}
