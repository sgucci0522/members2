<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\Button;
use Illuminate\Support\Facades\Blade;

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
    {
	    Blade::component('button',Button::class);
    }
}
