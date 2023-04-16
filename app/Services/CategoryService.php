<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Example;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ExampleServiceInterface;
use App\Traits\Crud;

class CategoryService implements CategoryServiceInterface
{
    use Crud;

    public $modelClass = Category::class;

    public function filter()
    {
        return $this->modelClass::where(function($query) {
                $query->where('name', 'LIKE', '%' . request('like') . '%');
            })
            ->get();
    }
    
    public function customStore($request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return $category;
    }

    public function getById($categoryId)
    {
        return Category::find($categoryId);
    }

}

