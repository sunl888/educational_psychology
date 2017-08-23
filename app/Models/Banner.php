<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Typeable;

class Banner extends BaseModel implements InterfaceTypeable
{
    use Typeable, Listable;
    protected $fillable = ['url', 'title', 'picture', 'type_id', 'order', 'is_visible'];
    protected static $allowSortFields = ['type_id', 'order', 'is_visible'];
    protected static $allowSearchFields = ['title', 'url'];
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
