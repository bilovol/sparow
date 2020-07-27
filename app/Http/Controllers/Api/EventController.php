<?php

namespace App\Http\Controllers\Api;

use App\Services\Donor\DonorService;
use App\Http\Controllers\Controller;


class EventController extends Controller
{
    // return allowed donor event keys
    public function index(DonorService $donorService)
    {
        return $this->response($donorService::getAllowedEventKeys());
    }

    // return fields from event keys
    public function show($event, DonorService $donorService)
    {
        return $this->response($donorService->getFieldsByEvent($event));
    }
}
