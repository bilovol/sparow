<?php
declare(strict_types=1);

namespace App\Http\Resources\Api\Automation;

use App\Services\AutomationService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $webhook = ($this->resource && !\is_array($this->resource))
            ? $this->resource->toArray() : (\is_array($this->resource) ? $this->resource : []);

        switch ($webhook['workflow']) {
            case AutomationService::WORKFLOW_EXPORT:
                $webhook['workflow'] = 'export';
                break;
            case AutomationService::WORKFLOW_POST:
                $webhook['workflow'] = 'post';
                break;
        }

        return $webhook;
    }

}
