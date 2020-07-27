<?php

namespace App\Services\Donor;

use Illuminate\Support\Facades\Cache;

trait  DonorCache
{
    public function getCacheFieldsByObject($object)
    {
        return Cache::store(config('donor.cache.storage'))->get($this->donorId . ':' . $object);
    }

    public function setCacheFieldsByObject($object, $value)
    {
        return Cache::store(config('donor.cache.storage'))->set($this->donorId . ':' . $object, $value, config('donor.cache.ttl'));
    }
}
