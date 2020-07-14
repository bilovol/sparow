<?php

namespace App\Http\Controllers;

use App\Repositories\AutomationRepository;
use App\Repositories\UserRepository;
use App\Services\SendPulse\AutomationService;
use App\Services\WebhookService;
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
    public function index(UserRepository $userRepository)
    {
//        $userId = 1;
//        $code = Str::random(30);
//        \Illuminate\Support\Facades\Cache::put($code, $userId, '5');
//        return redirect('/authorize/' . $code);
        $cookie = cookie('token', JWTAuth::fromUser($userRepository->get(1)), 60, '', '', false, false);

        return response()->redirectTo('/')->cookie($cookie);
    }


    public function test(WebhookService $service)
    {
//        return $service->getMapObjectIdBySource('order');
        return $service->getAllowedSource();
//        return $automationRepository->get(42);
//        return (new AutomationRepository())->create([
//            'user_id' => 1,
//            'webhook_id' => 1,
//            'workflow' => 0,
//            'meta' => ['book_id' => 123142],
//            'mapping' => ['1' => 2],
//            'source' => 'order.create',
//            'status' => 1,
//            'name' => 'NAME',
//        ]);

//        return (new AutomationRepository())->delete(53);

        return $automationService->create();
        //todo create WebhookRepository()
        //todo create UserRepository()
    }

}
