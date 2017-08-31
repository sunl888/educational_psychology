<?php

namespace App\Observers;

use App\Services\SettingCacheService;

class SettingObserver
{
    public function created()
    {
        app(SettingCacheService::class)->clearCache();
    }

    public function deleted()
    {
        app(SettingCacheService::class)->clearCache();
    }

    public function saved()
    {
        app(SettingCacheService::class)->clearCache();
    }
}
