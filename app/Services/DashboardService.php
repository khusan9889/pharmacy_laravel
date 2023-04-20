<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\DashboardServiceInterface;
use App\Traits\Crud;

class DashboardService implements DashboardServiceInterface
{
    use Crud;
    public function dash($request)
    {
        $count = Product::count();
        return $count;
    }


}
   