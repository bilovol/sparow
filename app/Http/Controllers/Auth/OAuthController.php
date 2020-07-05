<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SendPulse\SendPulseService;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OAuthController extends Controller
{
    public function redirectToLoginForm(SendPulseService $sendPulseService)
    {
        return $sendPulseService->getLoginFormUrl();
    }

    /**
     * @param Request $request
     * @param SendPulseService $sendPulseService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handleCallback(Request $request, SendPulseService $sendPulseService)
    {
        $sendPulseService->setNewSPUserByCodeAndState($request->code, $request->state);

        return view('oauth/callback',
            [
                'token' => JWTAuth::fromUser(User::findOrFail(1)),
            ]);
    }
}
