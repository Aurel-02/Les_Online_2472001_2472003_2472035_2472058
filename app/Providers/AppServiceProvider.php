<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Pattern\PTN\PTNRepositoryInterface;
use App\Pattern\PTN\StaticPTNRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PTNRepositoryInterface::class,
            StaticPTNRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
