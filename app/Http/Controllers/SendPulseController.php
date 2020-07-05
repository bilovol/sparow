<?php

namespace App\Http\Controllers;

use App\Services\SendPulse\SendPulseService;
use App\User;
use Illuminate\Http\Request;

class SendPulseController extends Controller
{
    public function listAddressBooks(SendPulseService $sendPulseService)
    {
        return $sendPulseService->listAddressBooks();
    }
}
