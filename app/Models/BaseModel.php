<?php

namespace App\Models;


use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use Sortable;

    protected function getImageUrl($image){
        if($image)
            return route(config('images.route_name'), $image);
        else
            return null;
    }
}
