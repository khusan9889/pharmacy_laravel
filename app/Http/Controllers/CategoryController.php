<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;
    public function category(CategoryServiceInterface $service)
    {
        return $this->success($service->filter());
    }

    

    public function store(Request $request, CategoryServiceInterface $service)
    {
        return $this->success($service->customStore($request));
    }


    public function getById($id, CategoryServiceInterface $service)
    {
        $category = $service->getById($id);

        if (!$category) {
            return $this->error("Category not found", 404);
        }

        return $this->success($category);
    }



}

