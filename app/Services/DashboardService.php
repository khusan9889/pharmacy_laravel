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

    public function dash_time($request)
    {
        $endDate = $request->get('end_date', date('Y-m-d'));
        $startDate = $request->get('start_date', date('Y-m-d', strtotime('-7 days', strtotime($endDate))));

        $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('date(created_at) as date, count(*) as count, sum(total_price) as sum')
            ->groupBy('date')
            ->get();

        $result = [];
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $count = 0;
            $sum = 0;
            foreach ($purchases as $purchase) {
                if ($purchase->date == $currentDate) {
                    $count = $purchase->count;
                    $sum = $purchase->sum;
                    break;
                }
            }
            $result[] = [
                'date' => $currentDate,
                'purchase' => $count,
                'sum' => $sum
            ];
            $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
        }

        return $result;
    }

}