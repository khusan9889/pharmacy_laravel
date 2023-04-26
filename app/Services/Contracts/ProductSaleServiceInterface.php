<?php

namespace App\Services\Contracts;

interface ProductSaleServiceInterface
{
    public function filter();

    public function customStore($request);

    public function customUpdate($id, $request);
}
