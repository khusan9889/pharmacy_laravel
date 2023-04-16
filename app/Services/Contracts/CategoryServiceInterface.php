<?php

namespace App\Services\Contracts;

interface CategoryServiceInterface
{
    public function filter();

    public function customStore($request);

    public function getById($id);

    // public function customUpdate($id, $request);
}

