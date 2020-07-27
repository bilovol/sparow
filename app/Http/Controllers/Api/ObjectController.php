<?php

namespace App\Http\Controllers\Api;

use App\Services\Donor\DonorService;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    // return allowed donor object keys
    public function index(DonorService $donorService)
    {
        return $this->response($donorService::getAllowedObjectKeys());
    }

    // return fields from object keys
    public function show($object, DonorService $donorService)
    {
        return $this->response($donorService->getFieldsByObject($object));
    }
}
