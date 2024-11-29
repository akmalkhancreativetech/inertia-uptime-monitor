<?php

namespace App\Providers;

use App\Models\Endpoint;
use App\Models\Site;
use App\Policies\EndpointPolicy;
use App\Policies\SitePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);
        Gate::policy(Site::class, SitePolicy::class);
        Gate::policy(Endpoint::class, EndpointPolicy::class);
    }
}
