<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\DashboardServiceInterface;
use App\Services\Contracts\ProductPurchaseServiceInterface;
use App\Services\Contracts\ProductSaleServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\PurchaseServiceInterface;
use App\Services\Contracts\ReferenceServiceInterface;
use App\Services\Contracts\SaleServiceInterface;
use App\Services\Contracts\StatisticsServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\DashboardService;
use App\Services\ProductPurchaseService;
use App\Services\ProductService;
use App\Services\ProductSaleService;
use App\Services\PurchaseService;
use App\Services\SaleService;
use App\Services\ReferenceService;
use App\Services\StatisticsService;
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
        $this->app->singleton(SaleServiceInterface::class, SaleService::class);
        $this->app->singleton(ProductSaleServiceInterface::class, ProductSaleService::class);
        $this->app->singleton(StatisticsServiceInterface::class, StatisticsService::class);
        $this->app->singleton(DashboardServiceInterface::class, DashboardService::class);
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
