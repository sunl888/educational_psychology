<?php

namespace App\Support\Widget;


abstract class AbstractWidget
{
    public $cacheTime = false;

    protected $viewName = '';

    protected $config = [];

    protected $viewNamespace = 'widget::';

    public function __construct($config = [])
    {
        $this->mergeConfig($config);
        if(isset($this->config['view']) && $this->config['view'])
            $this->setViewName($this->viewNamespace . $this->config['view']);
    }

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
        return $this->viewName ?: $this->viewNamespace . snake_case(class_basename(get_called_class()));
    }

    public function getData(array $params = [])
    {
        return $params;
    }

    public function render(array $params)
    {
        $data = array_merge($this->getData($params), $params);
        $data['widget'] = $this;
        return view($this->getViewName(), $data)->render();
    }

    public function cacheKey(array $params = [])
    {
        return $this->viewNamespace . serialize($params);
    }

    public function getConfig(){
        return $this->config;
    }

    public function mergeConfig($config)
    {
        if (!empty($config))
            $this->config = array_merge($this->config, $config);
        return $this;
    }
}
