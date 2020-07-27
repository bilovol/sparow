<?php

namespace App\Services;

use App\Repositories\WebhookRepository;
use App\Services\Donor\DonorService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_DISABLED = 0;

    protected $webhookRepository;

    public function __construct(WebhookRepository $webhookRepository)
    {
        $this->webhookRepository = $webhookRepository;
    }


    public function getIdByEvent($event)
    {
        $webhook = $this->webhookRepository->getByEventAndUserId($event, Auth::user()->id, ['id']);
        if (empty($webhook->id)) {
            $hash = md5(microtime(true) . microtime(true));
            $meta = app(DonorService::class)->bindWebhookByEvent($event, $hash);

            $webhook = $this->webhookRepository->create([
                'user_id' => Auth::user()->id,
                'event' => $event,
                'hash' => $hash,
                'meta' => $meta,
                'status' => self::STATUS_ACTIVE
            ]);

        }

        return $webhook->id;
    }


    public function delete($id)
    {
        return $this->webhookRepository->delete($id);
    }
}
