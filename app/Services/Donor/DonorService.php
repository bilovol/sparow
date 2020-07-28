<?php

namespace App\Services\Donor;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonorService extends DonorBaseService
{

    public function getObjectDataByKey($objectKey): ?array
    {
        return [
            'id' => 1,
            'phones' => [
                'id' => 1231,
                'value' => '0683850429',
                'type' => 'string',
                'times' => [
                    '0684839210',
                    '0683850419'
                ]
            ],
            'male' => true,
            'first_name' => 'Гриша',
            'last_name' => 'Батончик'
        ];
    }

    public function bindWebhookByEvent($event, $hash): ?array
    {
        return [
            'event' => $event,
            'url' => url('webhook/' . $event . '/' . $hash)
        ];
    }
}
