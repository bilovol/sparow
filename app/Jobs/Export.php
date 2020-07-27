<?php

namespace App\Jobs;

use App\Services\SendPulse\SendPulseService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Export extends BaseQueue
{
    private $bookId;
    public $user;

    public function __construct($user, string $event, array $mapping, array $meta)
    {
        $this->user = $user;
        $this->bookId = $meta['book_id'];
        parent::__construct($event, $mapping);
    }

    public function handle()
    {

        //TODO IT WORK
        parent::handle();
        Auth::login($this->user);
        Log::channel('telegram')->info(Auth::id());

        $result = app(SendPulseService::class)->getRefreshToken();

        Log::channel('telegram')->info($result);
    }
}
