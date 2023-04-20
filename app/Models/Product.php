<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Scopes;

    public $fillable = [
        'vendor_id',
        'name',
        'short_description',
        'barcode',
        'category_id',
        'type',
        'manufactured_date',
        'expired_date',
        'removed_date',
        'received_date',
        'amount',
        'package_type',
        'per_box',
        'package_amount',
        'country_id',
        'manufacturer',
        'price',
        'initial_price',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function products_purchase(): HasMany
    {
        return $this->hasMany(ProductPurchase::class);
    }
}

