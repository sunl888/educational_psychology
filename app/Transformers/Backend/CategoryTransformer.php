<?php

namespace App\Transformers\Backend;

use App\Models\Category;
use League\Fractal\TransformerAbstract;
use League\Fractal\Manager as FractalManager;

class CategoryTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['children'];
    protected $availableIncludes = ['children'];

    public function transform(Category $category)
    {
        $data = $this->transformData($category);
        return $data;
    }

    public function transformData($category)
    {
        return [
            'id' => $category->id,
            'type' => $category->type,
            'image' => $category->image,
            'image_url' => $category->image_url,
            'parent_id' => $category->parent_id,
            'cate_name' => $category->cate_name,
            'description' => $category->description,
            'url' => $category->url,
            'cate_slug' => $category->cate_slug,
            'is_nav' => $category->is_nav,
            'order' => $category->order,
            'page_template' => $category->page_template,
            'list_template' => $category->list_template,
            'content_template' => $category->content_template,
            'setting' => $category->setting,
            'created_at' => $category->created_at->toDateTimeString(),
            'updated_at' => $category->updated_at->toDateTimeString()
        ];
    }

    public function includeChildren(Category $category)
    {
        $transformer = new static;
        $transformer->setAvailableIncludes([]);
        $transformer->setDefaultIncludes([]);
        return $this->collection($category->children, $transformer);
    }
}
