<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('subscribed', function () {
            return auth()->check() && auth()->user()->membership()->exists();
        });

        \Blade::if('bonus', function(\App\Space $space) {
            return auth()->check() && auth()->user()->bonusesLeft($space);
        });

        \Blade::if('old', function ($filter, $value) {
            return (old($filter) == $value);
        });
        
        \Blade::if('match', function ($record, $value) {
            return ($record == $value);
        });
        
        \Blade::include('components.form.input');

        \Blade::include('components.form.textarea');

        \Blade::include('components.form.trix');

        \Blade::include('components.form.upload.image');
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
