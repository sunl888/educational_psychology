<?php


namespace App\Services;

use App\Models\Category;
use Cache;

class Navigation
{
    protected $allNav = null;
    /**
     * @var Category
     */
    protected $activeNav;
    /**
     * @var Category
     */
    protected $topNav;

    public function getAllNavWithoutCache()
    {
        return Category::nav()->topCategories()->with(['children' => function ($query) {
            $query->nav();
        }])->ordered()->ancient()->get();
    }

    public function getAllNav()
    {
        if (is_null($this->allNav)) {
            $this->allNav = Cache::remember('all_nav', config('cache.ttl'), function () {
                return $this->getAllNavWithoutCache();
            });
        }
        return $this->allNav;
    }

    public function clearCache()
    {
        return Cache::forget('all_nav');
    }

    /**
     * 设置当前导航
     * @param Category $activeNav
     */
    public function setActiveNav(Category $activeNav)
    {
        if (!$activeNav->isTopCategory()) {
            $this->topNav = $activeNav->parent;
        } else {
            $this->topNav = $activeNav;
        }
        $this->activeNav = $activeNav;
    }

    /**
     * 获取当前导航
     *
     * @param  \Illuminate\Http\Request $request
     * @return Category
     */
    public function getActiveNav()
    {
        return $this->activeNav;
    }

    /**
     * 获取当前所在的子导航的顶级导航
     *
     * @param  \Illuminate\Http\Request $request
     * @return Category
     */
    public function getActiveTopNav()
    {
        return $this->topNav;
    }

    public function getActiveChildrenNav()
    {
        // 这里不直接 return $this->topNav->children() 的原因是为了从缓存中获取数据
        $topNav = $this->getAllNav()->where('id', $this->topNav->id)->first();
        if (!is_null($topNav)) {
            return $topNav->children;
        } else {
            return collect();
        }
    }
}
