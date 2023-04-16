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
        $order = request('order', 'desc'); // get the value of the "order" query parameter or use "desc" as default
        return $this->modelClass::where(function($query) {
                $query->where('name', 'LIKE', '%' . request('like') . '%');
            })
            ->orderBy('id', $order)
            ->get();
    }

    public function getById($categoryId)
    {
        return Category::find($categoryId);
    }
    
    public function customStore($request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return $category;
    }

    public function customUpdate($id, $request)
    {
        $category = Category::find($id);

        if (!$category) {
            return null;
        }

        $category->name = $request->input('name');
        $category->save();

        return $category;
    }

    public function remove($id)
    {
        $model = $this->modelClass::where('id', $id)->first();
        $model->save();
    }

}

