<?php

namespace App\Http\Controllers\Traits;

use Request;

trait Authorizable
{
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
        'restore' => 'restore'
    ];

    /**
     * 覆盖 callAction 方法
     * 如果有不需要检查权限的方法，添加 $neednotCheckAuth 数组到控制器中
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if (!(isset($this->neednotCheckAuth) && in_array($method, $this->neednotCheckAuth))) {
            if ($ability = $this->getAbility($method)) {
                $this->authorize($ability);
            }
        }
        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', Request::route()->getName());
        $action = array_get($this->getAbilities(), $method);
        $resourceName = $routeName[count($routeName) - 2] . '.';
        return $action ? $resourceName . $action : $resourceName . $method;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * 添加权限
     * 例子 $this->addAbility(['visualOutput' => 'view']);
     * @param $ability
     */
    public function addAbility($ability)
    {
        $this->abilities = array_merge($this->abilities, $ability);
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
