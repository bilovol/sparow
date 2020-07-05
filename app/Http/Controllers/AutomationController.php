<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($request->user()->automations()->paginate(Automation::PER_PAGE));
    }

    public function store(Request $request)
    {
        return response()->json(['id' => 'NewAutomationId'], 201);//тут 201 и ид сущьности для того что-бы в дальнейшем можно было перейти
    }

    public function show(Request $request, $automationId)
    {
        return response()->json($request->user()->automations()->findOrFail($automationId));
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
