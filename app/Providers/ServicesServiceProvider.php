<?php

namespace App\Providers;

use App\Services\BannerService;
use App\Services\LinkService;
use App\Services\PostService;
use App\Services\SettingService;
use App\Services\TypeService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(UserService::class, function (){
           return new UserService();
        });

        $this->app->singleton(PostService::class, function (){
            return new PostService();
        });

        $this->app->singleton(BannerService::class, function (){
            return new BannerService();
        });

        $this->app->singleton(LinkService::class, function (){
            return new LinkService();
        });

        $this->app->singleton(SettingService::class, function (){
            return new SettingService();
        });

        $this->app->singleton(TypeService::class, function (){
            return new TypeService();
        });
    }
}
