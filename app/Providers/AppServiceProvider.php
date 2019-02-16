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
                'basicPlans' => \App\Plan::where('type', 'básico')->get(),
                'completePlans' => \App\Plan::where('type', 'completo')->get(),
                'memberships_count' => \App\Membership::count(),
                'upcomingWorkshop' => \App\Workshop::upcoming()->orderBy('starts_at', 'asc')->first()
            ]);
        });

        \Validator::extend('safePassUpdate', 'App\Rules\SafePassUpdate@passes');
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
