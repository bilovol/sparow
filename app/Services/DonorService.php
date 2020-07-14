<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\WebhookRepository;
use App\User;
use Exception;
use  \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class DonorService
{

    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;


    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function install()
    {
        $this->userRepository->create([
            'donor_id' => 'string',
            'donor_access' => ['доступы до донора'],
            'donor_info' => ['информация донора'],
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public function uninstall()
    {
        $id = 24;
        $this->userRepository->delete($id);
    }

    public function auth()
    {
        $donorId = 'donor_id';
        $this->userRepository->getByDonorId($donorId);
    }


}
