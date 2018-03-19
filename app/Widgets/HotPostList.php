<?php

namespace App\Widgets;

use App\Models\Post;
use App\Support\Widget\AbstractWidget;

class HotPostList extends AbstractWidget
{

    protected $config = [
        'limit' => 3,
        'status' => Post::STATUS_PUBLISH,
        'view' => ''
    ];

    public function getData(array $params = [])
    {
        $posts = Post::orderBy('views_count', 'desc')
            ->applyFilter(collect([
                'status' => $this->config['status'],
            ]))->latest()->limit($this->config['limit'])->get();

        return [
            'posts' => $posts,
        ];
    }
}
