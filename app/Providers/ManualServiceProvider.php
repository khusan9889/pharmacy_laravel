<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductPurchaseServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\PurchaseServiceInterface;
use App\Services\Contracts\ReferenceServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\ProductService;
use App\Services\ProductPurchaseService;
use App\Services\PurchaseService;
use App\Services\ReferenceService;
use App\Services\UserService;
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
        $this->app->singleton(UserServiceInterface::class, UserService::class);
        $this->app->singleton(PurchaseServiceInterface::class, PurchaseService::class);
        $this->app->singleton(ProductPurchaseServiceInterface::class, ProductPurchaseService::class);
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

