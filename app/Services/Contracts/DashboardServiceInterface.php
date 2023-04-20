<?php

namespace App\Services\Contracts;

interface DashboardServiceInterface
{
    public function filter();

    public function customStore($request);

    public function customUpdate($id, $request);
}
