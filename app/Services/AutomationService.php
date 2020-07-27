<?php

namespace App\Services;

use App\Http\Requests\Api\Automation\StoreRequest;
use App\Models\Automation;
use App\Models\Webhook;
use App\Repositories\AutomationRepository;
use App\User;
use Carbon\Carbon;
use Exception;
use  \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Pagination\Paginator;

class AutomationService
{

    public const WORKFLOW_EXPORT = 0;
    public const WORKFLOW_POST = 1;

    protected const COLUMNS = [
        'automations.id as id',
        'automations.user_id as user_id',
        'automations.workflow as workflow',
        'automations.meta as meta',
        'automations.mapping as mapping',
        'automations.rule as rule',
        'automations.status as status',
        'automations.name as name',
        'automations.created_at as created_at',
        'automations.updated_at as updated_at',
        'webhooks.event as event'
    ];

    protected $automationRepository;

    public function __construct(AutomationRepository $automationRepository)
    {
        $this->automationRepository = $automationRepository;
    }

    /**
     * @return Paginator
     */
    public function list(): Paginator
    {
        return $this->automationRepository->list(self::COLUMNS);
    }

    public function get($id)
    {
        return $this->automationRepository->get($id, self::COLUMNS);
    }

    public function create(StoreRequest $request)
    {
        $webhookId = app()->make(WebhookService::class)->getIdByEvent($request->event);

        $webhook = $this->automationRepository->create([
            'user_id' => Auth::user()->id,
            'webhook_id' => $webhookId,
            'workflow' => $request->workflow === 'export' ? self::WORKFLOW_EXPORT : self::WORKFLOW_POST,
            'meta' => $request->meta,
            'mapping' => $request->mapping,
            'status' => $request->status,
            'name' => $request->name
        ]);

        $webhook->event = $request->event;

        return $webhook;
    }

    public function update($id, StoreRequest $request)
    {
        $webhookId = app()->make(WebhookService::class)->getIdByEvent($request->event);

        return $this->automationRepository->update($id, [
            'webhook_id' => $webhookId,
            'workflow' => $request->workflow === 'export' ? self::WORKFLOW_EXPORT : self::WORKFLOW_POST,
            'meta' => $request->meta,
            'mapping' => $request->mapping,
            'status' => $request->status,
            'name' => $request->name
        ]);
    }

    public function delete($id)
    {
        $automation = $this->automationRepository->getById($id);
        if ($this->automationRepository->getCountByWebhookId($automation->webhook_id) < 2) {
            app()->make(WebhookService::class)->delete($automation->webhook_id);
        }

        return $automation->delete();
    }


}
