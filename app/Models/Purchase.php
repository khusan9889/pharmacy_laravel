<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    public $fillable = [
        'vendor_id',
        'total_price',
        'user_id',
    ];

    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, ProductPurchase::class);
    }

    public function product_purchases(): HasMany
    {
        return $this->hasMany(ProductPurchase::class);
    }
}


