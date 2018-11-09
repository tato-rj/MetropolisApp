<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view) {
            $view->with([
                'spaces' => \App\Space::all(),
                'basicPlans' => \App\Plan::where('type', 'basic')->get(),
                'completePlans' => \App\Plan::where('type', 'complete')->get()
            ]);
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
