<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get user info.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
//        если не получилось подключиться к SP отдаём 400 з сообщением
//        return response()->json('Cant connect to SP, show notice with btn. click and relocate sp oAUTH2', 400);
        return response()->json($request->user());
    }

    public function store(Request $request)
    {
//        тут меняем язык
        //200
    }
}

