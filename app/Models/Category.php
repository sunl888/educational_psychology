<?php

namespace App\Models;


class Category extends BaseModel
{

    protected $casts = [
        'is_nav' => 'boolean',
    ];
    protected $fillable = ['type', 'parent_id', 'cate_name',
        'description', 'url', 'is_target_blank', 'cate_slug', 'is_nav', 'order',
        'page_template', 'list_template', 'content_template'];


    const TYPE_POST = 'post', TYPE_PAGE = 'page', TYPE_LINK = 'link';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * 文章列表
     * @param  $query
     * @return mixed
     */
    public function postListWithOrder($order = null)
    {
        $query = $this->posts()->post()->publish()->orderByTop();
        switch ($order) {
            case 'default':
                $query->ordered()->recent();
                break;
            case 'recent':
                $query->recent()->ordered();
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc')->recent();
                break;
            default:
                $query->ordered()->recent();
                break;
        }
        return $query;
    }

    /**
     * 获取该分类的单页
     * @return mixed
     */
    public function page()
    {
        return $this->posts()->page()->first();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * 该分类是否为顶级分类
     *
     * @return bool
     */
    public function isTopCategory()
    {
        return $this->parent_id == 0;
    }

    /**
     * 导航栏查询作用域
     * @param $query
     * @return mixed
     */
    public function scopeNav($query)
    {
        return $query->where('is_nav', true);
    }

    /**
     * 顶级分类查询作用域
     * @param $query
     * @return mixed
     */
    public function scopeTopCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    /**
     * 文章分类查询作用域
     * @param $query
     * @param null $type
     * @return mixed
     */
    public function scopeByType($query, $type = null)
    {
        if (in_array($type, [static::TYPE_POST, static::TYPE_LINK, static::TYPE_PAGE])) {
            $query->where('type', $type);
        }
        return $query;
    }

    /**
     * 获取该分类下的文章数量
     *
     * @return mixed
     */
    public function getPostNum()
    {
        return $this->posts()->post()->count();
    }

    /**  * 判断是否为同一个分类
     *
     * @param  Category $category
     * @return bool
     */
    public function equals(Category $category)
    {
        return $this->id == $category->id;
    }

    /**
     * 判断当前栏目(分类)是否为外部链接
     *
     * @return bool
     */
    public function isExtLink()
    {
        return $this->type == static::TYPE_LINK;
    }

    /**
     * 判断当前栏目(分类)是否为单网页
     *
     * @return bool
     */
    public function isPage()
    {
        return $this->type == static::TYPE_PAGE;
    }

    /**
     * 判断当前栏目(分类)是否为列表栏目
     *
     * @return bool
     */
    public function isPostList()
    {
        return $this->type == static::TYPE_POST;
    }

    /**
     * 获取当前分类下的热门文章
     *
     * @param  $limit
     * @param  null $exceptPost
     * @return mixed
     */
    public function getHotPosts($limit, $exceptPost = null)
    {
        $query = $this->posts()->publishPost();
        if ($exceptPost != null) {
            if (is_numeric($exceptPost)) {
                $query->where('id', '!=', $exceptPost);
            } elseif ($exceptPost instanceof Post) {
                $query->where('id', '!=', $exceptPost->id);
            }
        }
        return $query->orderBy('views_count', 'desc')->recent()->limit($limit)->get();
    }

    public function getImageUrlAttribute()
    {
        return $this->getImageUrl($this->attributes['image']);
    }

}
