<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Automation\StoreRequest;
use App\Services\AutomationService;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    public function index(Request $request, AutomationService $automationService)
    {
        return $automationService->list();
    }

    public function store(StoreRequest $request, AutomationService $automationService)
    {
        dd($request);
        dd($request->workflow);
//        return $automationService->create();
//        return response()->json($automationRepository->create([]));
//        return response()->json(['id' => 'NewAutomationId'], 201);//тут 201 и ид сущьности для того что-бы в дальнейшем можно было перейти
    }

    public function show(Request $request, $automationId, AutomationService $automationService)
    {
        return $automationService->get($automationId);
    }

    public function update(Request $request, $automationId)
    {
//        200
    }

    public function destroy(Request $request)
    {
//        200
    }
}
