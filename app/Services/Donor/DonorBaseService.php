<?php

namespace App\Services\Donor;

use App\Http\Requests\Api\Auth\InstallRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\UninstallRequest;
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
        }
    }

    /**
     * Install and return token
     *
     * @param InstallRequest $request
     * @return string
     * @throws \Exception
     * @todo set new connect and return token
     */
    public function getTokenByInstallRequest(InstallRequest $request): string
    {
        $this->donorId = $request->donor_id;
        $this->donorAccess = [
            'access_token' => $request->access_token,
            'refresh_token' => $request->refresh_token,
        ];
        $this->donorInfo = ['domain' => $request->domain];


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
     * @param LoginRequest $request
     * @return string
     * @throws \Exception
     * @todo check installation and return token
     */
    public function getTokenByLoginRequest(LoginRequest $request): string
    {
        $this->donorId = $request->donor_id;
        $donor = $this->repository->getByDonorId($this->donorId);

        return JWTAuth::fromUser($donor);
    }

    /**
     *
     * @param UninstallRequest $request
     * @return bool
     * @throws \Exception
     */
    public function uninstall(UninstallRequest $request)
    {
        $this->donorId = $request->donor_id;
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
    public function getObjectDataByKey($objectKey): ?array
    {
        throw new \Exception('getObjectDataByKey() method not resolved');
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
