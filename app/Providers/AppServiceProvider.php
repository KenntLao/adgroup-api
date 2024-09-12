<?php

namespace App\Providers;

use App\Models\IpAddress;
use App\Observers\IpAddressObserver;
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
        IpAddress::observe(IpAddressObserver::class);
    }
}
