<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use Listable;

    protected static $allowSortFields = ['name', 'display_name', 'order'];
    protected static $allowSearchFields = ['name', 'display_name', 'description'];

    /**
     * 按 order 降序排序
     * @param $query
     * @return mixed
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }
}
