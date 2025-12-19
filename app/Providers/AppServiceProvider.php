<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Carbon\Carbon::setLocale('id');
        config(['app.locale' => 'id']);

        \Illuminate\Support\Facades\View::composer('include.navbar', function ($view) {
            $unreadNotificationsCount = auth()->check() 
                ? auth()->user()->notifications()->where('is_read', false)->count() 
                : 0;
            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
    }
}
