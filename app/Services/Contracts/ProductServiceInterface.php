<?php

namespace App\Services\Contracts;

interface ProductServiceInterface
{
    public function filter();

    public function store($request);
    public function customStore($request);
    
    public function customUpdate($id, $request);
    public function expired($request);
}
