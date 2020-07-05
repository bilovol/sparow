<?php

namespace App\Services\SendPulse;

use App\User;
use Exception;
use  \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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

    protected $isRefreshedToken = false;

    public function __construct()
    {
        $this->apiUrl = config('sendpulse.api.url');
        $this->tokenStorage = config('sendpulse.api.token.storage');
        $this->tokenStorageTtl = config('sendpulse.api.token.ttl');
        $this->cacheStorage = config('sendpulse.cache.storage');
        $this->cacheStorageTtl = config('sendpulse.cache.ttl');

        if (Auth::user()) {
            $this->setUserId(Auth::id());
            $this->setRefreshToken(Auth::user()->sp_refresh_token);
        }
    }

    public function setRefreshToken($value)
    {
        $this->refreshToken = $value;
    }


    public function setUserId($value)
    {
        $this->userId = $value;
    }

    private function setAccessToken($value)
    {
        $this->accessToken = $value;
        Cache::store($this->tokenStorage)->put($this->userId . ':sp_access_token', $this->accessToken, $this->tokenStorageTtl);
    }

    private function getAccessToken()
    {
        $this->accessToken = Cache::store($this->tokenStorage)->get($this->userId . ':sp_token');

        if (empty($this->accessToken) && $this->refreshToken) {
            $this->refreshTokens();
        }
    }

    private function refreshTokens()
    {
        $this->isRefreshedToken = true;

        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => config('services.sendpulse.client_id'),
            'client_secret' => config('services.sendpulse.client_secret'),
            'refresh_token' => $this->refreshToken,
        );

        $response = $this->sendRequest('/oauth/access_token', 'POST', $data, false);

        if (!empty($response['access_token']) && !empty($response['refresh_token'])) {

            $this->setAccessToken($response['access_token']);
            $this->setRefreshToken($response['refresh_token']);

            $user = User::findOrFail($this->userId);
            $user->sp_refresh_token = $this->refreshToken;
            $user->save();
        }
    }

    // API METHODS


    public function getUserInfo()
    {
        return $this->sendRequest('user/info')->json();
    }

    public function listAddressBooks()
    {
        $books = [];
        $next = true;
        $i = 0;
        while ($next) {
            $data['offset'] = $i >= 1 ? (100 * $i) : 0;
            $i++;

            $response = $this->sendRequest('addressbooks', 'GET', $data)->json();
            if (is_array($response) && count($response) > 0) {
                $books = array_merge($books, $response);
            } else {
                $next = false;
            }
        }

        return $books;
    }

    protected function sendRequest($path, $method = 'GET', $data = array(), $useToken = true)
    {

        if ($useToken && empty($this->accessToken)) {
            $this->getAccessToken();
        }

        $url = $this->apiUrl . '/' . $path;
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

        if ($response->failed() && $response->status() === 401 && !$this->isRefreshedToken) {
            $this->refreshTokens();
            $response = $this->sendRequest($path, $method, $data);
        }

        if ($response->serverError() || $response->clientError()) {
            throw new Exception($method . ':' . $path . ' | status: ' . $response->status() . ' | response: ' . $response->body());
        }

        return $response;
    }


    private function setTokens($accessToken, $refreshToken)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        Cache::store($this->tokenStorage)->put(Auth::user()->id . ':sp_token', $this->accessToken, $this->tokenStorageTtl);
    }

    ///////////////////////////////////////////////////////////////
    public function getLoginFormUrl()
    {
        $state = microtime(true);
        Cache::store($this->cacheStorage)->put($state, Auth::user()->id, 180);

        return [
            'url' => config('sendpulse.api.url') . '/oauth/authorize?response_type=code&client_id=' . config('services.sendpulse.client_id') . '&redirect_uri=' . config('services.sendpulse.redirect_uri') . '&state=' . $state
        ];
    }

    public function setNewSPUserByCodeAndState($code, $state)
    {
        $user = User::findOrFail(Cache::store($this->cacheStorage)->get($state));
        $tokens = $this->getTokensByCode($code);

        $this->setAccessToken($tokens['access_token']);
        $this->setRefreshToken($tokens['refresh_token']);

        $user->sp_refresh_token = $this->refreshToken;
        $user->sp_user_info = $this->getUserInfo();

        $user->save();
    }


    private function getTokensByCode($code)
    {
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.sendpulse.client_id'),
            'client_secret' => config('services.sendpulse.client_secret'),
            'redirect_uri' => config('services.sendpulse.redirect_uri'),
            'code' => $code,
        ];

        return $this->sendRequest('oauth/access_token', 'POST', $data, false);
    }
}
