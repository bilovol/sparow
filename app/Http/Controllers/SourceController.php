<?php

namespace App\Http\Controllers;

use App\Services\DonorService;
use App\Services\WebhookService;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index(WebhookService $webhookService)
    {
        return $webhookService::getAllowedSource();
    }

    public function show(Request $request, $source)
    {
//        fields by source
//        информация о полях относительно действия
        return response()->json([$source => 'value']);
    }

}
