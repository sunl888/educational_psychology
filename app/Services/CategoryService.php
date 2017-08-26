<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Arr;


class CategoryService
{
    private function filterData(array &$data, Category $category = null)
    {
        $filterValues = [
            Category::TYPE_LINK => ['cate_slug', 'page_template', 'list_template', 'content_template'],
            Category::TYPE_PAGE => ['url', 'is_target_blank', 'list_template', 'content_template'],
            Category::TYPE_POST => ['url', 'is_target_blank', 'page_template'],
        ];

        foreach ($filterValues as $type => $filterValue) {
            $cateType = isset($data['type']) ? $data['type'] : $category->type;
            if ($cateType == $type) {
                $data = Arr::except($data, $filterValue);
                break;
            }
        }
        if (isset($data['cate_name']))
            $data['cate_name'] = e($data['cate_name']);
        if (isset($data['description']))
            $data['description'] = e($data['description']);
        return $data;

    }

    public function create(array &$data)
    {
        $this->filterData($data);
        $category = Category::create($data);
        return $category;
    }

    public function update(Category $category, array &$data)
    {
        $this->filterData($data, $category);
        $category->fill($data)->save();
        return $category;
    }

}