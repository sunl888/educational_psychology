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
            'order' => $banner->order,
            'image' => $banner->image,
            'image_url' => $banner->image_url,
            'created_at' => $banner->created_at->toDateTimeString(),
            'updated_at' => $banner->updated_at->toDateTimeString()
        ];
    }
}
