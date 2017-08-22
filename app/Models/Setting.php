<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Typeable;
use Cache;

class Setting extends BaseModel implements InterfaceTypeable
{
    use Typeable, Listable;

    protected $fillable = ['name', 'value', 'description', 'type_id'];

    protected static $allowSortFields = ['name', 'value', 'description', 'type_id'];
    protected static $allowSearchFields = ['name', 'value'];

    private static $allSettings = null;

    public static function findByNameWithoutCache($name)
    {
        return static::query()->where('name', $name)->first();
    }

    public static function allSettingWithoutCache()
    {
        return static::recent()->get()->keyBy('name');
    }

    public static function allSetting()
    {
        if (is_null(static::$allSettings)) {
            static::$allSettings = Cache::remember(
                'setting:all', config('cache.ttl'), function () {
                return static::allSettingWithoutCache();
            });
        }
        return static::$allSettings;
    }

    public static function getSetting($name)
    {
        return static::allSetting()->get($name);
    }

}
