<?php

namespace App\Providers;

use App\Models\Jobs;
use App\Models\Client;
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
        View::composer('Admin.adminpanel', function ($view) {
            $all = Jobs::all()->count();
            $sale = Jobs::where('job_category', 'Sale')->count();
            $view->with(['all' => $all, 'sale' => $sale]);
        });


        // Composer for home.blade.php
        View::composer('home', function ($view) {
            $jobs = Jobs::all();
            $view->with(['jobs' => $jobs]);
        });
    }
}
