<?php

namespace App\Services\SendPulse;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Api\SendPulseService\UnauthorizedException;
use Psr\SimpleCache\InvalidArgumentException;

class SendPulseService
{

    protected $apiUrl;
    protected $userId;

    protected $accessToken;
    protected $refreshToken;

    protected $tokenStorage;
    protected $tokenStorageTtl;

    protected $cacheStorage;
    protected $cacheStorageTtl;

    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;

    protected $repository;

    protected $isRefreshedToken = false;

    public function __construct()
    {
        $this->apiUrl = config('sendpulse.api.url');
        $this->tokenStorage = config('sendpulse.api.token.storage');
        $this->tokenStorageTtl = config('sendpulse.api.token.ttl');
        $this->cacheStorage = config('sendpulse.cache.storage');
        $this->cacheStorageTtl = config('sendpulse.cache.ttl');
        $this->clientId = config('services.sendpulse.client_id');
        $this->clientSecret = config('services.sendpulse.client_secret');
        $this->redirectUri = config('services.sendpulse.redirect_uri');

        $this->userIdResolve();
        $this->setRepository();
    }


    public function getSecuritySignSalt()
    {
        return microtime(true);
    }

    public function setRepository()
    {
        return $this->repository = $this->repository ?? (new UserRepository());
    }

    /**
     * @throws Exception|InvalidArgumentException
     */
    private function getNewAccessToken()
    {
        $this->refreshToken = $this->getRefreshToken();
        if (null === $this->clientId) {
            throw new Exception('clientId not found, you must check config services.sendpulse.client_id');
        } elseif (null === $this->clientSecret) {
            throw new Exception('clientSecret not found, you must check config services.sendpulse.client_secret');
        }

        $this->isRefreshedToken = true;
        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
        );

        $response = $this->executeRequest('/oauth/access_token', 'POST', $data, false);

        if (!empty($response['access_token']) && !empty($response['refresh_token'])) {
            $this->setAccessToken($response['access_token']);
            $this->setRefreshToken($response['refresh_token']);
        }

        return $response['access_token'];
    }

    public function setUserId($value)
    {
        $this->userId = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setRefreshToken($value)
    {
        $this->refreshToken = $value;
    }

    public function setAccessToken($value)
    {
        $this->accessToken = $value;
        Cache::store($this->tokenStorage)->put($this->userId . ':sp_access_token', $this->accessToken, $this->tokenStorageTtl);
    }

    public function userIdResolve()
    {
        $this->setUserId(Auth::user()->id);
    }

    public function getRefreshToken()
    {
        return Auth::user()->sp_refresh_token;
    }

    public function userIdResolveByState($state)
    {
        $this->userId = Cache::store($this->cacheStorage)->get($state);
    }

    /**
     * @param string $refreshToken
     * @throws InvalidArgumentException
     * @throws UnauthorizedException
     */
    public function saveRefreshToken(string $refreshToken)
    {
        $user = $this->repository->get($this->userId);
        $user->sp_refresh_token = $refreshToken;

        $user->sp_user_info = $this->getUserInfo();

        $user->save();
    }

    /**
     * @param $path
     * @param string $method
     * @param array $data
     * @param bool $useToken
     * @return Response|mixed
     * @throws UnauthorizedException
     * @throws InvalidArgumentException|Exception
     */
    protected function executeRequest($path, $method = 'GET', $data = array(), $useToken = true)
    {
        if ($useToken) {
            $this->accessToken = $this->accessToken ?? Cache::store($this->tokenStorage)->get($this->userId . ':sp_access_token');
            $this->refreshToken = $this->refreshToken ?? $this->getRefreshToken();
            if (empty($this->accessToken)) {
                $this->getNewAccessToken();
                $this->saveRefreshToken($this->refreshToken);
            }
        }

        $url = $this->apiUrl . $path;
        $method = strtoupper($method);

        switch ($method) {
            case 'POST':
                $response = $useToken ? Http::withToken($this->accessToken)->asForm()->post($url, $data) : Http::asForm()->post($url, $data);
                break;
            case 'PUT':
                $response = Http::withToken($this->accessToken)->put($url, $data);
                break;
            case 'DELETE':
                $response = Http::withToken($this->accessToken)->delete($url, $data);
                break;
            default:
                $response = $useToken ? Http::withToken($this->accessToken)->get($url, $data) : Http::get($url, $data);
        }

        if ($response->clientError()) {
            switch (true) {
                case $response->status() === 401 && !$this->isRefreshedToken:
                    $this->getNewAccessToken();
                    $this->saveRefreshToken($this->refreshToken);
                    $response = $this->executeRequest($path, $method, $data);
                    break;
                case $response->status() === 401 || $response->status() === 400 && !$this->refreshToken:
                    throw new UnauthorizedException();
                    break;
                default:
                    throw new Exception($method . ':' . $path . ' | status: ' . $response->status() . ' | response: ' . $response->body());
            }
        }


        return $response;
    }

    /**
     * @return array
     * @throws UnauthorizedException
     * @throws InvalidArgumentException/Exception
     */
    public function getUserInfo()
    {
        return $this->executeRequest('/user/info')->json();
    }

    /**
     * @return mixed
     * @throws UnauthorizedException|Exception
     */
    public function listAddressBooks()
    {
        $books = [];
        $next = true;
        $i = 0;
        while ($next) {
            $data['offset'] = $i >= 1 ? (100 * $i) : 0;
            $i++;
            $response = $this->executeRequest('/addressbooks', 'GET', $data)->json();
            if (is_array($response) && count($response) > 0) {
                $books = array_merge($books, $response);
            } else {
                $next = false;
            }
        }

        return $books;
    }

    /**
     * @return string[]
     * @throws Exception
     */
    public function getLoginFormUrl()
    {
        if (null === $this->clientSecret) {
            throw new Exception('clientSecret not found, you must check config services.sendpulse.client_secret');
        } elseif (null === $this->redirectUri) {
            throw new Exception('redirectUri not found, you must check config services.sendpulse.redirect_uri');
        } elseif (null === $this->userId) {
            throw new Exception('userId id not found, you must call setUserId method before');
        }

        $state = $this->getSecuritySignSalt();
        Cache::store($this->cacheStorage)->put($state, $this->userId, 180);

        return [
            'url' => $this->apiUrl . '/oauth/authorize?response_type=code&client_id=' . $this->clientId . '&redirect_uri=' . $this->redirectUri . '&state=' . $state
        ];
    }

    /**
     * @param $code
     * @param $state
     * @throws UnauthorizedException|Exception
     */
    public function setTokensByCodeAndState($code, $state)
    {
        $this->userIdResolveByState($state);

        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ];

        $tokens = $this->executeRequest('/oauth/access_token', 'POST', $data, false);

        $this->setAccessToken($tokens['access_token']);
        $this->setRefreshToken($tokens['refresh_token']);
        $this->saveRefreshToken($this->refreshToken);
    }
}
