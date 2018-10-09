<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HomeProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
                ['auth.*', 'layouts.auth.*', 'social-right'], 'App\Http\ViewComposers\HomeComposer'
        );
        view()->composer(
                ['admin.*', 'layouts.admin.*'], 'App\Http\ViewComposers\AdminComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
