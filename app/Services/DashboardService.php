<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\ProductSale;
use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\Crud;
use App\Models\Purchase;
use App\Models\Sale;

class DashboardService implements DashboardServiceInterface
{
    use Crud;
    public function dash($request)
    {
        $currentDate = $request->get('date', date('Y-m-d'));
        
        $productCount = Product::count();

        $totalSales = Sale::sum('total_price');

        $expiredProductsCount = Product::where('expired_date', '<=', $currentDate)->count();

        return [
            'stock_products' => $productCount,
            'total_sales' => $totalSales,
            'expired_products' => $expiredProductsCount
        ];
    }

    public function dash_time($request)
    {
        $endDate = $request->get('date_end', date('Y-m-d'));
        $startDate = $request->get('date_start', date('Y-m-d', strtotime('-7 days', strtotime($endDate))));

        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('date(created_at) as date, count(*) as count, sum(total_price) as sum')
            ->groupBy('date')
            ->get();

        $result = [];
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $count = 0;
            $sum = 0;
            foreach ($sales as $sale) {
                if ($sale->date == $currentDate) {
                    $count = $sale->count;
                    $sum = $sale->sum;
                    break;
                }
            }
            $result[] = [
                'date' => $currentDate,
                'sale' => $count,
                'sum' => $sum
            ];
            $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
        }

        return $result;
    }

    public function today_sell($request)
    {
        $today = date('Y-m-d');

        $totalSoldAmount = ProductSale::whereDate('created_at', $today)->sum('count');
        $totalSoldPrice = Sale::whereDate('created_at', $today)->sum('total_price');
        $totalReceivedProducts = ProductPurchase::whereHas('purchase', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->sum('count');

        return [
            'sold_amount' => $totalSoldAmount,
            'sold_price' => $totalSoldPrice,
            'received_products' => $totalReceivedProducts,
        ];
    }

    public function today_purchase($request)
    {
        $today = date('Y-m-d');

        $totalPurchaseAmount = ProductPurchase::whereDate('created_at', $today)->sum('count');
        $totalPaidAmount = Purchase::whereDate('created_at', $today)->sum('total_price');
        $todayPurchaseCount = Purchase::whereDate('created_at', $today)->count();

        return [
            'today_purchase' => $todayPurchaseCount,
            'purchase_amount' => $totalPurchaseAmount,
            'paid_amount' => $totalPaidAmount,
            'purchase_date' => $today
        ];
    }
}