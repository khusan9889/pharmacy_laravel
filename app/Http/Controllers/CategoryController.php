<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index(CategoryServiceInterface $service)
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

    public function update($id, Request $request, CategoryServiceInterface $service)
    {
        return $this->success($service->customUpdate($id, $request));
    }

    public function delete($id)
    {
        Category::destroy($id);
        return $this->success();
    }

}

