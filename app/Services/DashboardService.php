<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\Crud;
use App\Models\Purchase;

class DashboardService implements DashboardServiceInterface
{
    use Crud;
    public function dash($request)
    {
        $currentDate = $request->get('date', date('Y-m-d'));
        
        $productCount = Product::count();

        $totalSales = Purchase::sum('total_price');

        $expiredProductsCount = Product::where('expired_date', '<=', $currentDate)->count();

        return [
            'stock_products' => $productCount,
            'total_sales' => $totalSales,
            'expired_products' => $expiredProductsCount
        ];
    }

}