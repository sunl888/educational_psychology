<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Typeable;

class Link extends BaseModel implements InterfaceTypeable
{
    use  Listable, Typeable;
    protected $fillable = ['name', 'url', 'logo', 'linkman', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['name', 'type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['name', 'url', 'linkman'];
    protected $casts = [
        'is_visible' => 'boolean'
    ];

    /**
     * 只获取显示的查询作用域
     * @param $query
     * @param bool $isVisible
     * @return mixed
     */
    public function scopeIsVisible($query, $isVisible = true)
    {
        return $query->where('is_visible', $isVisible)->ordered();
    }
}
