<?php

namespace App\Http\Controllers;

use App\Services\SendPulse\AutomationService;
use App\Services\SendPulse\SendPulseService;

class SendPulseController extends Controller
{
    public function listAddressBooks(SendPulseService $sendPulseService)
    {
        return $sendPulseService->listAddressBooks();
    }
}
