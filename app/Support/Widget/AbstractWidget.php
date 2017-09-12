<?php

namespace App\Support\Widget;


abstract class AbstractWidget
{
    public $cacheTime = false;

    protected $viewName = '';

    public function setViewName($viewName)
    {
        $this->viewName = $viewName;
        return $this;
    }

    /**
     * 如果 $this->viewName 为空， 那么默认的 viewName 为 Widget 子类类名
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName ?: 'theme::widgets.' . snake_case(class_basename(get_called_class()));
    }

    public function getData($args)
    {
        return $args;
    }

    public function render($args = [])
    {
        return view($this->getViewName(), $this->getData($args))->render();
    }

    public function cacheKey(array $params = [])
    {
        return 'widgets.' . serialize($params);
    }
}