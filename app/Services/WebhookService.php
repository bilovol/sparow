<?php

namespace App\Services;

use App\Repositories\AutomationRepository;
use App\Repositories\WebhookRepository;
use App\User;
use Exception;
use  \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class WebhookService
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_DISABLED = 0;

    protected $webhookRepository;

    public function __construct(WebhookRepository $webhookRepository)
    {
        $this->webhookRepository = $webhookRepository;
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /**
     * @return array
     */
    public static function getAllowedSource(): array
    {
        return array_keys(config('donor.source_of_object', []));
    }

    /**
     * Путь к ид обьекта
     * @param $source
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function getMapObjectIdBySource($source)
    {
        return config('donor.object_id_way.' . $source);
    }

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getIdBySource($source)
    {
        $webhook = $this->webhookRepository->getBySource($source, ['id']);
        $meta = [];

        if (empty($webhook->id)) {
            $hash = md5(microtime(true) . microtime(true));

            //todo register new webhook from DonorService return $meta;

            $webhook = $this->webhookRepository->create([
                'user_id' => Auth::user()->id,
                'source_tag' => $source,
                'hash' => $hash,
                'meta' => $meta,
                'status' => self::STATUS_ACTIVE
            ]);

        }

        return $webhook->id;
    }


    public function delete($id)
    {
        //todo delete by donor

        return $this->webhookRepository->delete($id);
    }
}
