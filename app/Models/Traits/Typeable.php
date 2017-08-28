<?php

namespace App\Models\Traits;

use App\Models\Type;

trait Typeable
{
    public function scopeByType($query, $type)
    {
        if ($type instanceof Type) {
            $typeId = $type->id;
        } elseif (is_array($type)) {
            $typeId = $type['id'];
        } else {
            $typeId = intval($type);
        }
        if ($typeId) {
            $query->where('type_id', $typeId);
        } else {
            $query->whereNull('type_id');
        }
        return $query;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
