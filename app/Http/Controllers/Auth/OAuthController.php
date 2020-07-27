<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\Donor\DonorService;
use App\Services\SendPulse\SendPulseService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OAuthController extends Controller
{

    public function install(Request $request, DonorService $donorService)
    {
        return response()->redirectTo('/')->cookie(
            cookie(
                'token', $donorService->getTokenByInstallRequest($request),
                env('JWT_TTL', 60),
                '',
                false,
                false,
                false
            )
        );
    }

    public function login(Request $request, DonorService $donorService)
    {
        return response()->redirectTo('/')->cookie(
            cookie(
                'token', $donorService->getTokenByLoginRequest($request),
                env('JWT_TTL', 60),
                '',
                false,
                false,
                false
            )
        );
    }

    public function uninstall(Request $request, DonorService $donorService)
    {
        $donorService->uninstall($request);

        return response('deleted');
        return response()->redirectTo('/')->cookie(
            cookie('token', '')
        );
    }


    public function redirectToLoginForm(SendPulseService $sendPulseService)
    {
        return $sendPulseService->getLoginFormUrl();
    }

    /**
     * @param Request $request
     * @param SendPulseService $sendPulseService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handleCallback(Request $request, SendPulseService $sendPulseService, UserRepository $userRepository)
    {
        $sendPulseService->setTokensByCodeAndState($request->code, $request->state);

        return view('oauth/callback',
            [
                'token' => JWTAuth::fromUser($userRepository->get($sendPulseService->getUserId())),
            ]);
    }
}
