<?php

namespace App\Services\Contracts;

interface PurchaseServiceInterface
{
    public function filter();

    public function customStore($request);

    public function customUpdate($id, $request);
}
