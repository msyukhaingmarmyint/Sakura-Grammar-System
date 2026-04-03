<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Level;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   Paginator::useBootstrap();

        View::composer('layouts.navbar', function ($view) {
            $view->with('levels', Level::all());
        });
    }
}
