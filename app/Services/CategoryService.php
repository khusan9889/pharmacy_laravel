<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Example;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ExampleServiceInterface;
use App\Traits\Crud;

class CategoryService implements CategoryServiceInterface
{

    public function filter()
    {
        return Category::whereLike('name')
        ->whereBetween2('created_at')
        ->whereBetween2('updated_at')
        ->sort()
        ->get();
    }

    // public function filter()
    // {
    //     return $this->modelClass::whereLike('name')
    //         ->whereEqual('key')
    //         ->whereBetween2('created_at')
    //         ->whereBetween2('updated_at')
    //         ->sort()
    //         ->customPaginate();
    // }

    // public function customStore($request)
    // {
    //     return $this->store($request);
    // }

    // public function customUpdate($id, $request)
    // {
    //     return $this->update($id, $request);
    // }
}
