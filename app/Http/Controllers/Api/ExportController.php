<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Export\StoreRequest;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function store(StoreRequest $request)
    {
        return $this->response('store');
    }
}
