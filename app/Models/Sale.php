<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory, Scopes;

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
        return $this->belongsToMany(Product::class, ProductSale::class)->withTimestamps();
    }

    public function product_sale(): HasMany
    {
        return $this->hasMany(ProductSale::class);
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}


