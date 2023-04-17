<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Services\Contracts\StatisticsServiceInterface;
use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    use ApiResponse;
    public function by_interval(Request $request, StatisticsServiceInterface $service)
    {
        return $this->success($service->interval_of_time($request));
    }

    public function common_products(Request $request, StatisticsServiceInterface $service)
    {
        return $this->success($service->common_products($request));
    }

    public function product_stats($id, StatisticsServiceInterface $service)
    {
        // $productId = $request->get('productId');
        return $this->success($service->product_stats($id));
    }
}
