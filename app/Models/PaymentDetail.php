<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    public $fillable = [
        'payment_method',
        'sale_id',

    ];

    public function sale()
    {
        return $this->hasOne(Purchase::class);
    }
    
}
