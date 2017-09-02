<?php

namespace App\Models;

use App\Models\Traits\Typeable;
use App\Observers\SettingObserver;
use Illuminate\Database\Eloquent\Builder;

class Setting extends BaseModel implements InterfaceTypeable
{
    use Typeable;

    protected $fillable = ['name', 'value', 'description', 'type_id', 'is_system'];

    protected static $allowSortFields = ['name', 'value', 'description', 'type_id'];
    protected static $allowSearchFields = ['name', 'value'];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notSystem', function (Builder $builder) {
            $builder->where('is_system', false);
        });

        static::observe(SettingObserver::class);
    }

    protected $casts = [
        'is_visible' => 'boolean'
    ];

}
