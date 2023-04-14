<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;
    public function index(ProductServiceInterface $service){
        return $this->success($service->filter());
    }

    public function store(Request $request, ProductServiceInterface $service){
        return $this->success($service->customStore($request));
    }

    public function update($id,Request $request, ProductServiceInterface $service){
        return $this->success($service->customUpdate($id, $request));
    }

    public function delete($id){
        Product::destroy($id);
        return $this->success();
    }

    public function expired(Request $request, ProductServiceInterface $service){
        return $this->success($service->expired($request));
    }
}
