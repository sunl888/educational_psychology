<?php

namespace App\Providers;

use App\Services\PostService;
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
    }
}
