<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PurchaseServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use ApiResponse;
    public function index(PurchaseServiceInterface $service)
    {
        return $this->success($service->filter());
    }
}
