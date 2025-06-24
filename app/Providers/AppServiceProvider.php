<?php

namespace App\Providers;

use App\Models\Event;
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
        // Share categories with all views
        View::composer('*', function ($view) {
            $view->with('categories', Event::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'));
        });
    }
}
