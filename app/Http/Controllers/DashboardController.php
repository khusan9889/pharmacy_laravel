<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;

    public function dashboard(Request $request, DashboardServiceInterface $service)
    {
        $data = $service->dash($request);
        return $this->success($data);
    }

}