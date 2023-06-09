<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Example;
use App\Services\Contracts\ReferenceServiceInterface;
use App\Traits\Crud;

class ReferenceService implements ReferenceServiceInterface
{
    public function filter()
    {
        return Country::whereLike('name')
            ->whereBetween2('created_at')
            ->whereBetween2('updated_at')
            ->sort()
            ->get();
    }
}
