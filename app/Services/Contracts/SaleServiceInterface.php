<?php

namespace App\Services\Contracts;

interface SaleServiceInterface
{
    public function filter();

    public function customStore($request);

    public function customUpdate($id, $request);
}
