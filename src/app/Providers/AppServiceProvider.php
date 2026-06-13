<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Pattern\PTN\PTNRepositoryInterface;
use App\Pattern\PTN\StaticPTNRepository;
use App\Pattern\Rekomendasi\RekomendasiStrategy;
use App\Pattern\Rekomendasi\TryoutRekomendasi;

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
        $this->app->bind(
            RekomendasiStrategy::class,
            TryoutRekomendasi::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observer Pattern Registration
        \App\Pattern\Observer\ActivityNotifier::getInstance()->attach(
            new \App\Pattern\Observer\DatabaseActivityLogger()
        );
    }
}
