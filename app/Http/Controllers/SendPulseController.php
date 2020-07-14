<?php

namespace App\Http\Controllers;

use App\Services\SendPulse\AutomationService;
use App\User;
use Illuminate\Http\Request;

class SendPulseController extends Controller
{
    public function listAddressBooks(AutomationService $sendPulseService)
    {
        return $sendPulseService->listAddressBooks();
    }
}
