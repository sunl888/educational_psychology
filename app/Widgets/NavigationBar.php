<?php


namespace App\Widgets;


use App\Models\Category;
use App\Support\Widget\AbstractWidget;

class NavigationBar extends AbstractWidget
{
    public function getData(array $params)
    {
        return [
            'navigations' => $this->getAllNav(),
        ];
    }

    private function getAllNav()
    {
        return Category::nav()->topCategories()->with(
            ['children' => function ($query) {
                $query->nav();
            }]
        )->ordered()->ancient()->get();
    }
}
