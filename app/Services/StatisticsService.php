<?php

namespace App\Services;

use App\Models\ProductPurchase;
use App\Services\Contracts\StatisticsServiceInterface;
use App\Traits\Crud;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class StatisticsService implements StatisticsServiceInterface
{
    use Crud;

    // public $modelClass = Example::class;

    // public function filter()
    // {
    //     return $this->modelClass::whereLike('name')
    //         ->whereEqual('key')
    //         ->whereBetween2('created_at')
    //         ->whereBetween2('updated_at')
    //         ->sort()
    //         ->customPaginate();
    // }

    public function interval_of_time($request)
    {
        return Purchase::with(['product_purchases.product'])
            ->whereBetween2('created_at', 'date')
            ->sort()
            ->customPaginate();
    }

    public function common_products($request)
    {
        $query = ProductPurchase::query();

        $results = $query->groupBy('product_id')
            ->select('product_id', DB::raw('SUM(count) as total_count'))
            ->whereBetween2('created_at', 'date')
            ->orderBy($request->get('orderBy', 'total_count'), $request->get('order', 'desc'))
            ->get();

        return $results;
    }


    public function product_stats($productId)
    {
        $query = ProductPurchase::query();
        $query = $query->where('product_id', $productId);
        $query->whereBetween2('created_at','date');

        $purchasesCount = $query->count();

        $totalPriceSum = $query->selectRaw('SUM(count * price) as total_price_sum')->first()->total_price_sum;

        return [
            'purchases_count' => $purchasesCount,
            'total_price_sum' => $totalPriceSum,
        ];
    }

    public function by_user($userId = null)
    {
        $query = Purchase::query();
        $query->selectRaw('user_id, COUNT(*) as purchase_count');
        $query->whereBetween2('created_at','date');
        
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        $query->groupBy('user_id');
        $results = $query->get();

        return $results;
    }

    public function category($categoryId = null)
    {
        $query = ProductPurchase::query();
        $query->join('products', 'product_purchase.product_id', '=', 'products.id');
        $query->select('products.category_id', 'categories.name', DB::raw('COUNT(*) as purchase_count'));
        $query->leftJoin('categories', 'products.category_id', '=', 'categories.id');
        $query->whereBetween2('created_at','date');

        if ($categoryId) {
            $query->where('products.category_id', $categoryId);
        }

        $query->groupBy('products.category_id', 'categories.name');
        $results = $query->get();

        return $results;
    }

}
