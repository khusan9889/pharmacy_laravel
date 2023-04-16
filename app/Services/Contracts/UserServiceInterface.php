<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function filter();

    public function getById($id);

    public function customStore($request);

    public function customUpdate($id, $request);
}
