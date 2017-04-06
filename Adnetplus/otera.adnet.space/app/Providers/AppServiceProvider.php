<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('time_cs', function($attribute, $value, $parameters) {
            if( preg_match('/([01]?[0-9]|2[0-3]) (AM|PM)$/', $value) )
                return true;
            return false;
        });
        // custom validate
        \Validator::extend('tel', function ($attribute, $value, $parameters)
        {
            if( preg_match("/^([0-9\s\-\+\(\)]*)$/", $value) )
                return true;
            return false;
        });
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
