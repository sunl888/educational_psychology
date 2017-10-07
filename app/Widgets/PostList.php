<?php


namespace App\Widgets;


use App\Models\Category;
use App\Models\Post;
use App\Support\Widget\AbstractWidget;

class PostList extends AbstractWidget
{

    protected $config = [
        'category' => null,
        'limit' => 10,
        'status' => Post::STATUS_PUBLISH
    ];

    public function getData(array $params = [])
    {
        $categoryId = $this->config['category'] instanceof Category ? $this->config['category']->id : $this->config['category'];

        return [
            'posts' => Post::applyFilter(collect([
                'category_id' => $categoryId,
                'status' => $this->config['status']
            ]))->limit($this->config['limit'])->get()
        ];
    }

}
