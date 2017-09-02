<?php

namespace App\Models;

use App\Models\Traits\Typeable;

class Banner extends BaseModel implements InterfaceTypeable
{
    use Typeable;
    protected $fillable = ['url', 'title', 'image', 'type_id', 'is_visible'];
    protected static $allowSortFields = ['type_id', 'is_visible'];
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

    public function getImageUrlAttribute()
    {
        return $this->getImageUrl($this->attributes['image']);
    }

}
