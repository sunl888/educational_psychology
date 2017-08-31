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
}
