<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;
    public function index(ProductServiceInterface $service)
    {
        return $this->success($service->filter());
    }

    public function store(StoreProductRequest $request, ProductServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }

    public function update($id, UpdateProductRequest $request, ProductServiceInterface $service)
    {
        return $this->success($service->customUpdate($id, $request));
    }

    public function delete($id)
    {
        Product::destroy($id);
        return $this->success();
    }

    public function expired(Request $request, ProductServiceInterface $service)
    {
        return $this->success($service->expired($request));
    }
}
