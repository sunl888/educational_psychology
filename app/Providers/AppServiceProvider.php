<?php

namespace App\Providers;

use Faker\Generator as Faker;
use Illuminate\Support\ServiceProvider;
use App\FakerProviders\Internet;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment() !== 'production') {
            $faker = app(Faker::class);
            $faker->addProvider(new Internet($faker));

            DB::listen(function ($query) {
                $sql = str_replace('?', '%s', $query->sql);
                $sql = sprintf($sql, ...$query->bindings);
                Log::info('sql', [$sql, $query->time]);
            });

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
