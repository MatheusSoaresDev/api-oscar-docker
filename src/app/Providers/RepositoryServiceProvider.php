<?php

namespace App\Providers;

use App\Repositories\Contracts\HostRepositoryInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Repositories\Core\Eloquent\EloquentHostRepository;
use App\Repositories\Core\Eloquent\EloquentOscarRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            OscarRepositoryInterface::class,
            EloquentOscarRepository::class
        );

        $this->app->bind(
            HostRepositoryInterface::class,
            EloquentHostRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
