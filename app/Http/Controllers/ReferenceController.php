<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ReferenceServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    use ApiResponse;
    public function country(ReferenceServiceInterface $service)
    {
        return $this->success($service->filter());
    }
}
