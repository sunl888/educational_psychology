<?php


namespace App\Widgets;


use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepository;
use App\Support\Widget\AbstractWidget;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ImagePost extends AbstractWidget
{

    protected $config = [
        'category' => null,
        'limit' => 1,
        'status' => Post::STATUS_PUBLISH,
        'view' => 'image_post_list'
    ];

    private $categoryRepository;

    public function getData(array $params = [])
    {
        if (!$this->categoryRepository) {
            $this->categoryRepository = app(CategoryRepository::class);
        }
        if ($this->config['category'] instanceof Category)
            $category = $this->config['category'];
        else {
            try {
                $category = $this->categoryRepository->findByCateName($this->config['category']);
            } catch (ModelNotFoundException $e) {
                $category = new Category(['cate_name' => $this->config['category']]);
            }
        }
        if ($category->exists) {
            $posts = Post::whereNotNull('cover')
                ->applyFilter(collect([
                    'category_id' => $category->id,
                    'status' => $this->config['status']
                ]))->latest()->limit($this->config['limit'])->get();
        } else {
            $posts = collect();
        }
        return [
            'image_posts' => $posts,
        ];
    }

}
