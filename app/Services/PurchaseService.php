<?php

namespace App\Services;

use App\Models\Purchase;
use App\Services\Contracts\PurchaseServiceInterface;
use App\Traits\Crud;

class PurchaseService implements PurchaseServiceInterface
{
    use Crud;

    public $modelClass = Purchase::class;

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
