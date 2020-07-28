<?php

namespace App\Services\Donor;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;


trait  DonorEvent
{

    public static function getAllowedEventKeys(): array
    {
        return array_keys(config('donor.eventToObject', []));
    }

    public static function getObjectKeyByEvent($event)
    {
        return config('donor.eventToObject.' . $event, null);
    }

    public static function getAllowedObjectKeys(): array
    {
        return array_values(
            array_unique(
                array_values(
                    config('donor.eventToObject', [])
                )
            )
        );
    }

    public static function getObjectIdMappingByEvent($event)
    {
        return config('donor.object_id_mapping.' . $event);
    }

    //return getObject id by event eky from webhookRequest
//    public function getObjectIdByEventKeyFromWebhookRequest(Request $request, $eventKey)
//    {
//        return Arr::get($this->prepareIncomingData($request), self::getObjectIdMappingByEvent($eventKey));
//    }
//
//
//    public function prepareIncomingData(array $array): array
//    {
//        return Arr::dot($array);
//    }
}
