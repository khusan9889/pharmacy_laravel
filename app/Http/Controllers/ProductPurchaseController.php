<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ProductPurchaseServiceInterface;
use App\Services\Contracts\PurchaseServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    use ApiResponse;
    public function purchase(Request $request, ProductPurchaseServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }
}
