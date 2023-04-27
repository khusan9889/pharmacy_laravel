<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Purchase;
use App\Services\Contracts\ProductServiceInterface;
use App\Traits\Crud;
use Illuminate\Support\Facades\Auth;

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
        // Check if a product with the same barcode and expired date already exists
        $model = Product::where('barcode', $request->barcode)
            ->where('expired_date', $request->expired_date)
            ->where('price', $request->price)
            ->first();

        // If the product already exists, update the amount column
        if ($model) {
            $model->count += $request->count;
            $model->save();
        } else {
            // Otherwise, create a new product with the validated data
            $model =  $this->store($request);

            // Create a new Purchase record
            $purchase = new Purchase();
            $purchase->received_date = now();
            $purchase->total_price = $request->price * $request->count; // Assuming price is for one unit
            $purchase->vendor_id = $request->vendor_id; // Assuming the vendor_id is available in the request
            $purchase->user_id = Auth::user()->id; // Assuming the currently logged in user is the one who made the purchase
            $purchase->save();
        }

        // Calculate and update the package_amount column
        if ($model->per_box != null && $model->per_box > 0) {
            $model->package_count = $model->count / $model->per_box;
            $model->save();
        }

        return $model;
    }

    public function customUpdate($id, $request)
    {
        $model = Product::where('barcode', $request->barcode)
            ->where('expired_date', $request->expired_date)
            ->first();

        if ($model) {
            return $this->update($id, $request);
        } else {
            return ['message' => 'Product not found'];
        }
    }

    public function expired($request)
    {
        return $this->modelClass::where('expired_date', '<=', $request->get('date', date('Y-m-d')))
            ->sort()
            ->customPaginate();
    }

    public function expire($request)
    {
        $this->modelClass::where('expired_date', '<=', $request->get('date', date('Y-m-d')))
            ->update([
                'removed_date' => date('Y-m-d')
            ]);
    }
    public function removeById($id)
    {
        $model = $this->modelClass::where('id', $id)->first();
        $model->removed_date = date('Y-m-d');
        $model->save();
    }
}
