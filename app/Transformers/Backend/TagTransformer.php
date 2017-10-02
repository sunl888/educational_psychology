<?php

namespace App\Transformers\Backend;

use App\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{

    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'slug' => $tag->slug,
            'created_at' => $tag->created_at->toDateTimeString(),
            'updated_at' => $tag->updated_at->toDateTimeString()
        ];
    }
}
