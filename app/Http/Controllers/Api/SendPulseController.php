<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Automation\StoreRequest;
use App\Services\SendPulse\SendPulseService;

class SendPulseController extends Controller
{
    public function listAddressBooks(SendPulseService $sendPulseService)
    {
//        return $sendPulseService->listAddressBooks();
        return [['id'=>2, 'name'=>'delete this shit']];
    }
}
