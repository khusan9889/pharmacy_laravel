<?php

namespace App\Http\Controllers;

use App\Services\Contracts\SaleServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    use ApiResponse;
    public function index(SaleServiceInterface $service)
    {
        return $this->success($service->filter());
    }
}
