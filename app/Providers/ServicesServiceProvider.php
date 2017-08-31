<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\SettingCacheService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(CategoryService::class, function () {
            return new CategoryService();
        });
        $this->app->singleton(PostService::class, function () {
            return new PostService();
        });
        $this->app->singleton(SettingCacheService::class, function () {
            return new SettingCacheService();
        });
    }
}
