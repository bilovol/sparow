<?php

namespace App\Jobs;

use App\Services\SendPulse\SendPulseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


abstract class BaseQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;
    public $mapping;
    public $user;
    public $objectData;

    public function __construct(string $event, array $mapping)
    {
        $this->event = $event;
        $this->mapping = $mapping;
    }

    public function handle()
    {
    }
}
