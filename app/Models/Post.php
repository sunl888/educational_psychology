<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends BaseModel
{
    use SoftDeletes, Listable;

    protected $fillable = ['title', 'user_id', 'excerpt', 'type', 'views_count', 'cover', 'status', 'template', 'top', 'published_at', 'category_id'];
    protected $dates = ['deleted_at', 'top', 'published_at', 'created_at', 'updated_at'];
    protected static $allowSearchFields = ['title', 'excerpt'];
    protected static $allowSortFields = ['title', 'status', 'views_count', 'top', 'order', 'published_at', 'category_id'];

    const STATUS_PUBLISH = 'publish', STATUS_DRAFT = 'draft';

    public function scopeBySlug($query, $slug)
    {
        $query->where('slug', $slug);
    }


    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeApplyFilter($query, $data)
    {
        $data = $data->only('status', 'only_trashed', 'category_id');
        $query->orderByTop()
            ->byCategory(isset($data['category_id']) ? $data['category_id'] : null)
            ->byType(Category::TYPE_POST)
            ->withSimpleSearch()
            ->withSort()
            ->byStatus(isset($data['status']) ? $data['status'] : null);

        if (isset($data['only_trashed']) && $data['only_trashed']) {
            $query->onlyTrashed();
        }
        return $query->ordered()->recent();
    }

    public function scopeByCategory($query, $category)
    {
        if ($category instanceof Category) {
            $category = $category->id;
        } else {
            $category = intval($category);
        }
        if ($category)
            $query->where('category_id', $category);
    }


    public function scopeByType($query, $type)
    {
        if (in_array($type, [Category::TYPE_POST, Category::TYPE_PAGE]))
            return $query->where('type', $type);
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        if (in_array($status, [static::STATUS_PUBLISH, static::STATUS_DRAFT]))
            return $query->where('status', $status);
        else
            return $query->publishOrDraft();
    }

    /**
     * 获取已发布或草稿的文章的查询作用域
     * @param $query
     * @return mixed
     */
    public function scopePublishOrDraft($query)
    {
        return $query->where('status', static::STATUS_PUBLISH)->orWhere('status', static::STATUS_DRAFT);
    }

    /**
     * 已发布文章的查询作用域
     * @param $query
     * @return mixed
     */
    public function scopePublishPost($query)
    {
        return $query->where(function ($query) {
            $query->byType(Category::TYPE_POST)->byStatus(static::STATUS_PUBLISH);
        });
    }

    public function scopeOrderByTop($query)
    {
        return $query->orderBy('top', 'DESC');
    }

    public function addViewCount()
    {
        Post::where($this->getKeyName(), $this->getKey())->increment('views_count');
        $this->views_count++;
    }

    /**
     * 一对一关联 post_content 表
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postContent()
    {
        return $this->hasOne(PostContent::class);
    }


    /**
     * 文章是否置顶
     */
    public function isTop()
    {
        return !is_null($this->top);
    }

    /**
     * 获取下一篇文章
     * @return mixed
     */
    public function getNextPost()
    {
        return $this->category->posts()->publishPost()->where('id', '>', $this->id)->first();
    }

    public function isPublish()
    {
        return $this->status == static::STATUS_PUBLISH;
    }

    public function isDraft()
    {
        return $this->status == static::STATUS_DRAFT;
    }

    public function getCoverUrlAttribute()
    {
        return $this->getImageUrl($this->attributes['cover']);
    }

    public function getTemplate()
    {
        if (!is_null($this->template) && view()->exists($this->template)) {
            return $this->template;
        } else {
            return $this->category->getContentTemplate();
        }
    }
}
