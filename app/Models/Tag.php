<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Post;
use App\Models\Traits\HasSlug;

class Tag extends BaseModel
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'creator_id'];

    /**
     * 获得拥有此 tag 的文章。
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function slugMode()
    {
        return setting('tag_slug_mode');
    }
}
