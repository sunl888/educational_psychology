<?php

namespace App\Services;

use App\Repositories\SettingRepository;
use Cache;

class SettingCacheService
{

    private $allSettings = null;


    public function all()
    {
        if (is_null($this->allSettings)) {
            $this->allSettings = Cache::remember('setting:all', config('cache.ttl'), function () {
                return app(SettingRepository::class)->allSettingWithoutCache();
            });
        }
        return $this->allSettings;
    }

    public function get($name, $default = null)
    {
        return $this->all()->get($name, $default);
    }
}
