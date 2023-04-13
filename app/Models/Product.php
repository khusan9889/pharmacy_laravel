<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'vendor_id',
        'name',
        'short_description',
        'barcode',
        'category_id',
        'type',
        'manufactured_date',
        'expired_date',
        // 'removed_date',
        'received_date',
        'amount',
        'package_type',
        'per_box',
        'package_amount',
        'country_id',
        'manufacturer',
        'price',
        'trade_price',
    ];
}
