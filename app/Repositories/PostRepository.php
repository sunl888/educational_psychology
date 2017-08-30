<?php

namespace App\Repositories;


use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;

class PostRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function filterData(array &$data)
    {
        //todo slug
        $data['slug'] = '';
        if (isset($data['title']))
            $data['title'] = e($data['title']);
        if (isset($data['excerpt']))
            $data['excerpt'] = e($data['excerpt']);
        if (isset($data['content']))
            $data['content'] = clean($data['content']);
        // 处理置顶
        if (isset($data['top'])) {
            if ($data['top']) {
                $data['top'] = Carbon::now();
            } else {
                $data['top'] = null;
            }
        }
        if (isset($data['published_at']))
            $data['published_at'] = new Carbon($data['published_at']);

        return $data;
    }

    public function preCreate(array &$data)
    {
        $this->filterData($data);
        // 创建文章时 如果没有传入 published_at 字段，将 published_at 设置为 Carbon::now()
        if (!isset($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }
        // 创建文章时 如果没有传入 type 字段，type 默认设置为 Category::TYPE_POST
        if (!isset($data['type']))
            $data['type'] = Category::TYPE_POST;
        // 创建文章时 如果没有传入 status 字段，status 默认设置为 Post::STATUS_DRAFT
        if (!isset($data['status']))
            $data['status'] = Post::STATUS_DRAFT;
        return $data;
    }

    public function created(&$data, $post)
    {
        $this->updateOrCreatePostContent($post, $data);
    }

    public function preUpdate(array &$data)
    {
        return $this->filterData($data);
    }

    public function updated(&$data, $post)
    {
        $this->updateOrCreatePostContent($post, $data);
    }

    /**
     * 更新或创建文章正文
     * @param Post $post
     * @param $content
     */
    private function updateOrCreatePostContent(Post $post, &$data)
    {
        if (isset($data['content'])) {
            $post->postContent()->updateOrCreate(
                [], [
                    'content' => $data['content']
                ]
            );
        }
    }

}