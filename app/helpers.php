<?php

use App\Services\SettingCacheService;

if (!function_exists('setting')) {
    function setting($name = null, $default = null)
    {
        $settingCacheService = app(SettingCacheService::class);
        if (is_null($name)) {
            return $settingCacheService;
        }
        return $settingCacheService->get($name, $default);
    }
}
