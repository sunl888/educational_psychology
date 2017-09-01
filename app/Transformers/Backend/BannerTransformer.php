<?php

namespace App\Transformers\Backend;

use App\Models\Banner;
use League\Fractal\TransformerAbstract;

class BannerTransformer extends TransformerAbstract
{

    public function transform(Banner $banner)
    {
        return [
            'id' => $banner->id,
            'url' => $banner->url,
            'title' => $banner->title,
            'image' => $banner->image,
            'image_url' => $banner->image_url,
            'is_visible' => $banner->is_visible,
            'type_id' => $banner->type_id,
            'created_at' => $banner->created_at->toDateTimeString(),
            'updated_at' => $banner->updated_at->toDateTimeString()
        ];
    }
}
