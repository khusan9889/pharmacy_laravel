<?php

namespace App\Services;

use App\Models\Sale;
use App\Services\Contracts\SaleServiceInterface;
use App\Traits\Crud;

class SaleService implements SaleServiceInterface
{
    use Crud;

    public $modelClass = Sale::class;

    public function filter()
    {
        return $this->modelClass::whereLike('name')
            ->whereEqual('key')
            ->whereBetween2('created_at')
            ->whereBetween2('updated_at')
            ->sort()
            ->customPaginate();
    }

    public function customStore($request)
    {
        return $this->store($request);
    }

    public function customUpdate($id, $request)
    {
        return $this->update($id, $request);
    }
}
