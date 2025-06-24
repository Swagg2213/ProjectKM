<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\EventReview;
use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function ($view) {
            $unreadNotificationsCount = 0;
            if (Auth::check() && Auth::user()->role->name === 'Pembuat Event') {
                $user = Auth::user();
                $unreadNotificationsCount = EventReview::whereHas('event', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->whereNull('read_at')->count();
            }

            $view->with('categories', Event::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'))
                 ->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
    }
}
