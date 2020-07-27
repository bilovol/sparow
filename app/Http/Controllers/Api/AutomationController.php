<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Automation\StoreRequest;
use App\Http\Resources\Api\Automation\AutomationCollectionResource;
use App\Http\Resources\Api\Automation\AutomationResource;
use App\Services\AutomationService;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    /**
     * @param Request $request
     * @param AutomationService $automationService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, AutomationService $automationService)
    {
        return $this->response(new AutomationCollectionResource($automationService->list()));
    }

    /**
     * @param Request $request
     * @param $automationId
     * @param AutomationService $automationService
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $automationId, AutomationService $automationService)
    {
        return $this->response(new AutomationResource($automationService->get($automationId)));
    }

    public function store(StoreRequest $request, AutomationService $automationService)
    {
        return $this->response(new AutomationResource($automationService->create($request)));
    }

    public function update($id, StoreRequest $request, AutomationService $automationService)
    {
        return $this->response(['result' => (bool)$automationService->update($id, $request)]);
    }

    public function destroy($id, AutomationService $automationService)
    {
        return $this->response(['result' => (bool)$automationService->delete($id)]);

    }
}
