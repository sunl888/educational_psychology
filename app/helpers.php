<?php

use App\Services\SettingCacheService;
use App\Repositories\SettingRepository;

if (!function_exists('setting')) {
    /**
     * 获取或设置网站设置
     * 获取: setting('setting_name', 'default_value');
     * 设置: 1. setting(['setting_name1' => 'value1', 'setting_name2' => 'value2']);
     *      2. setting(['setting_name1' => ['value' => 'value_test', 'is_system' => true]]);
     * @param null $name
     * @param null $default
     * @return SettingCacheService|\Illuminate\Foundation\Application|mixed|null|void
     */
    function setting($name = null, $default = null)
    {
        if (is_null($name)) {
            return app(SettingCacheService::class);
        }

        if (is_array($name)) {
            return app(SettingRepository::class)->set($name);
        }

        $setting = app(SettingCacheService::class)->get($name);

        if (!is_null($setting)) {
            return $setting->value;
        }
        return value($default);
    }

}
