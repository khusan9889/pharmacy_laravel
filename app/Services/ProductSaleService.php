<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use App\Services\Contracts\ProductSaleServiceInterface;
use App\Traits\Crud;

class ProductSaleService implements ProductSaleServiceInterface
{
    use Crud;

    public $modelClass = ProductSale::class;

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

        // Initialize an array to hold the formatted product quantities
        $formattedProductQuantities = [];

        // Initialize a variable to hold the total price of the sale
        $totalPrice = 0;

        // Loop through each product and format the quantity data
        foreach ($productQuantities as $productQuantity) {
            $productId = $productQuantity['product_id'];
            $quantity = $productQuantity['count'];

            $product = Product::findOrFail($productId);

            //check if amount of products is bigger than we want to sale
            if ($product->count < $quantity) {
                throw new \Exception('Not enough amount of products: ' . $product->name);
            }

            $formattedProductQuantities[] = [
                'product_id' => $productId,
                'count' => $quantity,
                'price' => $product->price,
            ];

            $product->count -= $quantity;

            // Calculate the package amount if the product comes in a package
            if ($product->per_box != null && $product->per_box > 0) {
                $product->package_count = (int)($product->count / $product->per_box);
            }

            $product->save();

            $totalPrice += $product->price * $quantity;
        }

        // Create the product sale
        $sale = new Sale();

        $sale->total_price = $totalPrice; // set the total price of the sale
        $sale->user_id = auth()->user()->id; // set the user ID of the sale
        
        $sale->save();

        // Attach the products to the product sale
        foreach ($formattedProductQuantities as $formattedProductQuantity) {
            $sale->products()->attach([
                $formattedProductQuantity['product_id'] => [
                    'count' => $formattedProductQuantity['count'],
                    'price' => $formattedProductQuantity['price'],
                ],
            ]);
        }

        return $sale;
    }

    public function customUpdate($id, $request)
    {
        return $this->update($id, $request);
    }
}


