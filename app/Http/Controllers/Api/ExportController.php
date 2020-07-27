<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;

class ExportController extends Controller
{
    public function store(Request $request)
    {
        return $this->response('store');
    }
}
