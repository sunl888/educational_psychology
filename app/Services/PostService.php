<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;


class PostService
{
    private function filterData(array &$data)
    {
        if (isset($data['title']))
            $data['title'] = e($data['title']);
        if (isset($data['excerpt']))
            $data['excerpt'] = e($data['title']);
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

    public function create(array &$data)
    {
        $this->filterData($data);
        // 创建文章时 如果没有传入 published_at 字段，将 published_at 设置为 Carbon::now()
        if (!isset($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }
        // 创建文章时 如果没有传入 type 字段，type 默认设置为 Category::TYPE_POST
        if (!isset($data['type']))
            $data['type'] = Category::TYPE_POST;
        $post = Post::create($data);
        $this->updateOrCreatePostContent($post, $data);
        return $post;
    }

    public function update(Post $post, array &$data)
    {
        $this->filterData($data);
        $post->fill($data)->save();
        $this->updateOrCreatePostContent($post, $data);
        return $post;
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