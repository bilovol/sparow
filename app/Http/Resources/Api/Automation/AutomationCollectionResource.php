<?php
declare(strict_types=1);

namespace App\Http\Resources\Api\Automation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;


class AutomationCollectionResource extends ResourceCollection
{


    public $collects = AutomationResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'result' => true,
            'data' => $this->collection,
            'pagination' => [
                'current_page' => $this->currentPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
            ]
        ];
    }


}
