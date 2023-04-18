<?php

namespace App\Services\Contracts;

interface StatisticsServiceInterface
{
    // public function filter();

    public function interval_of_time($request);

    public function common_products($request);

    public function product_stats($request);

    public function by_user($id);

    public function category($id);

    public function extended_products($request, $id);

    public function extended_users($request, $id);
   
}
