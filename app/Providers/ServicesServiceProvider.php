<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(UserService::class, function (){
           return new UserService();
        });
    }
}
