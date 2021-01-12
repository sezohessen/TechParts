<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
        app()->singleton('app_locale', function ()
        {
            if (session()->has('app_locale')) {
                //$language = session('app_locale');
                $language = session()->get('app_locale');
            } else {
                $language = 'ar';
            }
            return $language;
        });
    }
}
