<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @deprecated // перенести на WebhookService
     */
    public function index(Request $request)
    {
        //список всех доступных вебхуков
        return response()->json([
            'order.create', 'order.update', 'order.destroy'
        ]);
    }

    public function show(Request $request, $source)
    {
//        fields by source
//        информация о полях относительно действия
        return response()->json([$source => 'value']);
    }

}
