<?php

namespace App\Services\Contracts;

interface DashboardServiceInterface
{
    public function dash($request);

    public function dash_time($request);

    public function today_sell($request);

    public function today_purchase($request);

    public function stock_out($request);
}