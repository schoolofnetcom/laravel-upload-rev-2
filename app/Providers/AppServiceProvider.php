<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Photo;
use App\Observers\PhotoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Photo::observe(PhotoObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
