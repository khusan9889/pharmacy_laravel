<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Services\Contracts\ProductSaleServiceInterface;
use App\Traits\ApiResponse;

class ProductSaleController extends Controller
{
    use ApiResponse;
    public function sale(StorePurchaseRequest $request, ProductSaleServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }
}

