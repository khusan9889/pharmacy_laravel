<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Services\Contracts\ProductPurchaseServiceInterface;
use App\Traits\Crud;
use Carbon\Carbon;

class ProductPurchaseService implements ProductPurchaseServiceInterface
{
    use Crud;

    public $modelClass = ProductPurchase::class;

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
        // Get the array of product IDs and amounts from the request
        $productQuantities = $request->get('products');

        if (!$productQuantities) {
            return null; // or handle the error in some other way
        }

        // Initialize a variable to hold the total price of the purchase
        $totalPrice = 0;

        // Loop through each product and update the count
        foreach ($productQuantities as $productQuantity) {
            $productId = $productQuantity['product_id'];
            $quantity = $productQuantity['count'];

            $product = Product::findOrFail($productId);
            
            // increase product's amount
            $product->count += $quantity;

            // Calculate the package amount if the product comes in a package
            if ($product->per_box != null && $product->per_box > 0) {
                $product->package_count = (int)($product->count / $product->per_box);
            }

            $product->save();

            $totalPrice += $product->price * $quantity;
        }

        // Create the product purchase
        $purchase = new Purchase();

        $purchase->total_price = $totalPrice; // set the total price of the purchase
        $purchase->received_date = Carbon::now(); // set the received date of the purchase
        $purchase->user_id = auth()->user()->id; // set the user ID of the purchase
        $purchase->vendor_id = auth()->user()->vendor_id; // set the vendor ID of the purchase

        $purchase->save();
        // Attach the products to the product purchase
        foreach ($productQuantities as $productQuantity) {
            $productId = $productQuantity['product_id'];
            $quantity = $productQuantity['count'];

            $product = Product::findOrFail($productId);

            $productPurchase = new ProductPurchase([
                'count' => $quantity,
                'price' => $product->price,
                'product_id' => $productId // add product_id to the new ProductPurchase object
            ]);

            $purchase->product_purchase()->save($productPurchase);
        }

        return $purchase;
    }

    public function customUpdate($id, $request)
    {
        return $this->update($id, $request);
    }
}
