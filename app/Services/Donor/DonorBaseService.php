<?php

namespace App\Services\Donor;

use App\Repositories\AutomationRepository;
use App\Repositories\UserRepository;
use App\Repositories\WebhookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class DonorBaseService
{
    use DonorEvent;

    protected $repository;
    protected $donorClient;

    protected $donorId;
    protected $donorAccess;
    protected $donorInfo;


    public function __construct()
    {
        $this->repository = new UserRepository();

        if (!empty(Auth::user()->donor_id) &&
            !empty(Auth::user()->donor_access) &&
            !empty(Auth::user()->donor_info)
        ) {
            $this->donorId = Auth::user()->donor_id;
            $this->donorAccess = Auth::user()->donor_access;
            $this->donorInfo = Auth::user()->donor_info;

            $this->donorClient = $this->getDonorClient();
            $this->getDonorClient();
        }
    }

    /**
     * Install and return token
     *
     * @param Request $request
     * @return string
     * @throws \Exception
     * @todo set new connect and return token
     */
    public function getTokenByInstallRequest(Request $request): string
    {
        $this->donorId = $this->getDonorIdFromInstallRequest($request);
        $this->donorAccess = $this->getDonorAccessFromInstallRequest($request);
        $this->donorInfo = $this->getDonorInfoFromInstallRequest($request);


        $donor = $this->repository->create([
            'donor_id' => $this->donorId,
            'donor_access' => $this->donorAccess,
            'donor_info' => $this->donorInfo
        ]);

        return JWTAuth::fromUser($donor);
    }

    /**
     * Check installation and return token
     *
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function getTokenByLoginRequest(Request $request): string
    {
        $this->donorId = $this->getDonorIdFromLoginRequest($request);
        $donor = $this->repository->getByDonorId($this->donorId);
        $this->donorAccess = $donor->donor_access;
        $this->donorInfo = $donor->donor_info;

        return JWTAuth::fromUser($donor);
    }

    /**
     *
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function uninstall(Request $request)
    {
        $this->donorId = $this->getDonorIdFromUninstallRequest($request);
        $donor = $this->repository->getByDonorId($this->donorId);

        $this->donorAccess = $donor->donor_access;
        $this->donorInfo = $donor->donor_info;

        $webhooks = (new WebhookRepository())->getByUserId($donor->id);
        if ($webhooks) {
            foreach ($webhooks as $webhook) {
                $this->unbindWebhookByEvent($webhook->event);
                $webhook->delete();
            }
        }

        (new AutomationRepository())->deleteByUserId($donor->id);

        $donor->delete();

        return true;
    }

    public function deleteWebhooksByUserId($userId)
    {
        $webhookRepository = new WebhookRepository();
        $webhooks = $webhookRepository->getByUserId($userId);

        if (empty($webhooks)) {
            return true;
        }

        foreach ($webhooks as $webhook) {
            $this->unbindWebhookByEvent($webhook->event);
            $webhook->delete();
        }

        return true;
    }


    public function getFieldsByEvent($event): array
    {
        return $this->getFieldsByObject(self::getObjectKeyByEvent($event));
    }


    public function getFieldsByObject($object): array
    {
        $cacheFields = $this->getCacheFieldsByObject($object);
        if ($cacheFields) {
            return $cacheFields;
        }

        $fields = Arr::dot($this->getObjectDataByKey($object));
        if (count($fields) > 0) {
            $this->setCacheFieldsByObject($object, $fields);
            return $fields;
        }

        return [];
    }


    public function getCacheFieldsByObject($object)
    {
        return Cache::store(config('donor.cache.storage'))->get($this->donorId . ':' . $object);
    }

    public function setCacheFieldsByObject($object, $value)
    {
        return Cache::store(config('donor.cache.storage'))->set($this->donorId . ':' . $object, $value, config('donor.cache.ttl'));
    }


    /**
     * @param $objectKey
     * @return array|null
     * @throws \Exception
     * @todo return first event object
     */
    public
    function getObjectDataByKey($objectKey): ?array
    {
        throw new \Exception('getObjectDataByKey() method not resolved');
    }

    /**
     * @throws \Exception
     * @todo set $this->donorClient
     */
    public
    function getDonorClient()
    {
        throw new \Exception('getDonorClient() method not resolved');
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @todo return donor id form install request
     */
    public
    function getDonorIdFromInstallRequest(Request $request)
    {
        throw new \Exception('getDonorIdFromInstallRequest() method not resolved');
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @todo return additional donor info from install request
     */
    public
    function getDonorInfoFromInstallRequest(Request $request): ?array
    {
        throw new \Exception('getDonorInfoFromInstallRequest() method not resolved');
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     * @todo return tokens from install request
     */
    public
    function getDonorAccessFromInstallRequest(Request $request): array
    {
        throw new \Exception('getDonorAccessFromInstallRequest() method not resolved');
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     * @todo return donor id from uninstall request
     */
    public
    function getDonorIdFromUninstallRequest(Request $request): string
    {
        throw new \Exception('getDonorIdFromUninstallRequest() method not resolved');
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     * @todo return donor id from login request
     */
    public
    function getDonorIdFromLoginRequest(Request $request): string
    {
        throw new \Exception('getDonorIdFromLoginRequest() method not resolved');
    }

    /**
     * @param string $event
     * @param string $hash
     * @return array
     * @throws \Exception
     * @todo set webhook by donor event key and return info
     */
    public
    function bindWebhookByEvent($event, $hash): ?array
    {
        throw new \Exception('bindWebhookByEvent() method not resolved');
    }

    /**
     * @param string $event
     * @return bool
     * @throws \Exception
     * @todo disable webhook by donor event key and return bool
     */
    public
    function unbindWebhookByEvent($event): bool
    {
        throw new \Exception('bindWebhookByEvent() method not resolved');
    }
}
