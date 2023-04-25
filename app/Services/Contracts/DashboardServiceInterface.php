<?php

namespace App\Services\Contracts;

interface DashboardServiceInterface
{
    public function dash($request);

    public function dash_time($request);
}