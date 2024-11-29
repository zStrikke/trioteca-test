<?php

namespace App\Providers;

use App\Models\Dwelling;
use App\Observers\DwellingObserver;
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
        Dwelling::observe(DwellingObserver::class);
    }
}
