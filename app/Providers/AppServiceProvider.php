<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        View::composer('components.layout', function ($view) {
        if (Auth::check()) 
        {
            $notifications = Notification::where('userID', Auth::id())
                ->where('cancelled', 0)
                ->get(['id', 'notificationText']);

            $view->with('notifications', $notifications);
        }
    });
    }
}
