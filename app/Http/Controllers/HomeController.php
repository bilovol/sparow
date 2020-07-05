<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $userId = 1;
//        $code = Str::random(30);
//        \Illuminate\Support\Facades\Cache::put($code, $userId, '5');
//        return redirect('/authorize/' . $code);
        $cookie = cookie('token', JWTAuth::fromUser(User::findOrFail(1)), 60, '', '', false, false);
        return response()->redirectTo('/')->cookie($cookie);
    }
}
