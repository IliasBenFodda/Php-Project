<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::composer('layouts.navigation', function ($view) {
            $notifications = collect();

            if (auth()->check() && auth()->user()->isAdmin()) {
                $notifications = auth()->user()->unreadNotifications;
            }

            $view->with('adminNotifications', $notifications);
        });
    }
}
