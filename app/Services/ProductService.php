<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;
use App\Traits\Crud;

class ProductService implements ProductServiceInterface
{
    use Crud;

    public $modelClass = Product::class;

    public function filter()
    {
        return $this->modelClass::with(['category', 'country'])
            ->sort()
            ->customPaginate();
    }

    public function customStore($request)
    {
        return $this->store(new \Illuminate\Http\Request($request->except(['removed_date'])));
        // return $this->store($request);
    }

    public function store($request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
            'expired_date' => 'required|date',
            'amount' => 'required|integer|min:1'
        ]);

        // Check if a product with the same barcode and expired date already exists
        $existingProduct = Product::where('barcode', $validatedData['barcode'])
                                ->where('expired_date', $validatedData['expired_date'])
                                ->first();

        // If the product already exists, update the amount column
        if ($existingProduct) {
            $existingProduct->amount += $validatedData['amount'];
            $existingProduct->save();
        } else {
            // Otherwise, create a new product with the validated data
            Product::create($validatedData);
        }

        return redirect('/products')->with('success', 'Product has been added.');
    }

    public function customUpdate($id, $request)
    {
        return $this->update($id, $request);
    }

    public function expired($request)
    {
        return $this->modelClass::where('expired_date', '<=', $request->get('date', date('Y-m-d')))
        ->sort()
        ->customPaginate();
    }

    public function remove($request)
    {
        // $models = $this->modelClass::where('expired_date', '<=', $request->get('date', date('Y-m-d')))->get();
        // foreach($models as $item){
        //     $item->removed_date = date('Y-m-d');
        //     $item->save();
        // }
        $this->modelClass::where('expired_date', '<=', $request->get('date', date('Y-m-d')))
        ->update([
            'removed_date' => date('Y-m-d')
        ]);

    }
    public function removeById($id)
    {
        // $this->modelClass::where('id', $id)
        // ->update([
        //     'removed_date' => date('Y-m-d')
        // ]);
        $model = $this->modelClass::where('id',$id)->first();     
        $model->removed_date = date('Y-m-d');
        $model->save();
   
    }

}
