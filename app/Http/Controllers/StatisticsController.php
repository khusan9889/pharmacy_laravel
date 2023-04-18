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
        return $this->success($service->product_stats($id));
    }

    public function users_stats(StatisticsServiceInterface $service, $id = null)
    {
        return $this->success($service->by_user($id));
    }

    public function bycat(StatisticsServiceInterface $service, $id = null)
    {
        return $this->success($service->category($id));
    }

    public function extended_prod(Request $request, StatisticsServiceInterface $service, $id = null)
    {
        return $this->success($service->extended_products($request, $id));
    }
}


