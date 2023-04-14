<?php

namespace App\Providers;

use App\Services\Contracts\ExampleServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\ProductService;
use App\Services\ExampleService;
use Illuminate\Support\ServiceProvider;

class ManualServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->app->singleton(ExampleServiceInterface::class, ExampleService::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
