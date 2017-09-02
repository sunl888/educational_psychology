<?php

namespace App\Models;

use App\Models\Traits\Typeable;

class Link extends BaseModel implements InterfaceTypeable
{
    use Typeable;
    protected $fillable = ['name', 'url', 'logo', 'linkman', 'type_id', 'is_visible'];
    protected static $allowSortFields = ['name', 'type_id', 'is_visible'];
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
        return $query->where('is_visible', $isVisible);
    }

    public function getLogoUrlAttribute()
    {
        return $this->getImageUrl($this->attributes['logo']);
    }
}
