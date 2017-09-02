<?php

namespace App\Transformers\Backend;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(?Post $post)
    {
        if(is_null($post)){
            return [];
        }
        return [
            'id' => $post->id,
            'title' => $post->title,
            'type' => $post->type,
            'views_count' => $post->views_count,
            'template' => $post->template,
            'published_at' => $post->published_at->toDateTimeString(),
            'created_at' => $post->created_at->toDateTimeString(),
            'updated_at' => $post->updated_at->toDateTimeString()
        ];
    }
}
