<?php

namespace App\Services\Contracts;

interface StatisticsServiceInterface
{
    public function filter();

    public function customStore($request);

    public function customUpdate($id, $request);
}
