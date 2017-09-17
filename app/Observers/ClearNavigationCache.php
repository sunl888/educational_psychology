<?php

namespace App\Observers;


use App\Services\Navigation;

class ClearNavigationCache
{
    public function created($category)
    {
        if ($category->is_nav)
            app(Navigation::class)->clearCache();
    }

    public function deleted($category)
    {
        if ($category->is_nav)
            app(Navigation::class)->clearCache();
    }

    public function saved($category)
    {
        if ($category->is_nav)
            app(Navigation::class)->clearCache();
    }
}
