<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ExampleServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReferenceServiceInterface;
use App\Services\ProductService;
use App\Services\ExampleService;
use App\Services\ReferenceService;
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
        $this->app->singleton(ReferenceServiceInterface::class, ReferenceService::class);
        $this->app->singleton(CategoryServiceInterface::class, CategoryService::class);
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

