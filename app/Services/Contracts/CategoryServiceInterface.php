<?php

namespace App\Services\Contracts;

interface CategoryServiceInterface
{
    public function filter();

    public function customStore($request);

    // public function customUpdate($id, $request);
}

