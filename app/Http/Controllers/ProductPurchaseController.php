<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Services\Contracts\ProductPurchaseServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    use ApiResponse;
    public function purchase(StorePurchaseRequest $request, ProductPurchaseServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }
}
