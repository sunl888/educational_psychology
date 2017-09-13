<?php


namespace App\Widgets;


use App\Services\CustomOrder;
use App\Support\Widget\AbstractWidget;
use App\Widgets\Link as LinkModel;

class Link extends AbstractWidget
{
    public function getData(array $params)
    {
        return [
            'links' => app(CustomOrder::class)->order(LinkModel::byType($this->config['type'])->recent()->get()),
        ];
    }

}
