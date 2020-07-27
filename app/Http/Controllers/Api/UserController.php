<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return $this->response(new UserResource($request->user()));
    }

    public function store(Request $request)
    {
//        тут меняем язык
        //200
    }
}

