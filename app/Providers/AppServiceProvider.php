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
            $marketing = Jobs::where('job_category', 'Marketing')->count();
            $advertising = Jobs::where('job_category', 'Advertising')->count();
            $marketing = Jobs::where('job_category', 'Marketing')->count();
            $HR = Jobs::where('job_category', 'HR')->count();
            $finance = Jobs::where('job_category', 'Finance')->count();
            $IT = Jobs::where('job_category', 'IT')->count();
            $Art = Jobs::where('job_category', 'Creative and Art')->count();
            $audit = Jobs::where('job_category', 'Audit')->count();
            $view->with([
                'all' => $all, 'sale' => $sale, 'marketing' => $marketing, 'advertising' => $advertising,
                'HR' => $HR, 'finance' => $finance, 'IT' => $IT, 'Art' => $Art, 'audit' => $audit
            ]);
        });

        View::composer('header', function ($view) {
            $companies = Jobs::select('company')->distinct()->get();
            $categories = Jobs::select('job_category')->distinct()->get();
            $view->with([
                'companies' => $companies,
                'categories' => $categories
            ]);
        });

        View::composer('header2', function ($view) {
            $companies = Jobs::select('company')->distinct()->get();
            $categories = Jobs::select('job_category')->distinct()->get();
            $view->with([
                'companies' => $companies,
                'categories' => $categories
            ]);
        });
    }
}
