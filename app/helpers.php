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

if (!function_exists('image_url')) {

    function image_url($imageId, $style = null, $default = null)
    {
        if (is_null($imageId)) {
            return value($default);
        }
        $parameters = ['image' => $imageId];
        if (!is_null($style))
            $parameters['p'] = $style;

        return route(config('images.route_name'), $parameters);
    }

}

if (!function_exists('array_swap')) {

    function array_swap(&$array, $i, $j)
    {
        if ($i != $j && array_key_exists($i, $array) && array_key_exists($j, $array)) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
        return $array;
    }

}
