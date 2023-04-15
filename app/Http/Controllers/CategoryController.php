<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{
    use ApiResponse;
    public function index(CategoryServiceInterface $service)
    {
        return $this->success($service->filter());
    }

    // public function store()
}
