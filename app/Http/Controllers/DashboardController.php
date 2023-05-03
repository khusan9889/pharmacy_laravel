<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    use ApiResponse;

    public function dashboard(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->dash($request);
        return $this->success($data);
    }

    public function dash_time(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->dash_time($request);
        return $this->success($data);
    }

    public function today_sell(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->today_sell($request);
        return $this->success($data);
    }

    public function today_purchase(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->today_purchase($request);
        return $this->success($data);
    }

    public function stock_products(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->stock_out($request);
        return $this->success($data);
    }

}